import $ from 'jquery';
import axios from 'axios';
import alasql from 'alasql';

$(document).ready(() => {

    $('code').each((index, element) => {
        const keywordColor = '#eddf91';
        const colorizedKeywords = [ 'show', 'select', 'columns', 'from', 'as', 'on', 'inner', 'join', 'on' ];

        let value = element.innerHTML.split(/\s+/).map(keyword => {
            if (colorizedKeywords.includes(keyword)) {
                return keyword.fontcolor(keywordColor);
            } else {
                return keyword;
            }
        });
        
        element.innerHTML = value.join(' ');
    });

    axios.get('/api/query-data')
        .then(response => {
            
            ['films', 'people', 'planets', 'species', 'starships', 'vehicles'].forEach(category => {
                alasql(`create table ${category}`);
                alasql.tables[category].data = response.data[category];
            });

            console.log('Dataset has been loaded')
        })
        .catch(error => {
            console.error(error);
        });

    $('#query-input').on({
        keydown: (event) => {
            if (event.keyCode == 13) {
                event.preventDefault();
                $('#query-output').text('');
                
                let query = event.target.value;
                let result = null;

                try {
                    result = alasql(query);
                } catch (e) {
                    $('#query-output').text(`Error! Check query syntax`);
                    return;
                }

                if (result == null || result.length == 0) {
                    $('#query-output').text('Query returned 0 results');
                    return;
                }
                
                $('#query-output').html(() => {

                    let output = '';
                    let keys = Object.getOwnPropertyNames(result[0]);

                    output += '<tr>';
                    output += keys.map(name => `<td>${name}</td>`).join('');
                    output += '</tr>';

                    result.forEach(row => {
                        output += '<tr>';

                        keys.forEach(key => {
                            output += '<td>';
                            output += row[key];
                            output += '</td>';
                        });

                        output += '</tr>';
                    });

                    return output;
                });
            }
        }
    });
});
