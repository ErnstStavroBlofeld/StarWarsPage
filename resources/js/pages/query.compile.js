import $ from 'jquery';
import axios from 'axios';
import alasql from 'alasql';

$(document).ready(() => {

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
                
                let query = event.target.value;
                let result = null;

                try {
                    result = alasql(query);
                } catch (e) {
                    console.error(e);
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