import $ from 'jquery';

$(document).ready(() => {
    $('.entity label').each((index, element) => {
        const target = $(element).prop('for');
        const label = $(element).text();

        if (target == null || label == null) {
            console.error('Invalid entity label', target, label);
        } else {
            if (window.localStorage.getItem(target) != label) {
                console.info(`Entity ${target} label (${label}) has been cached`)
                window.localStorage.setItem(target, label);
            }
        }
    });

    $('.entity a[data-identifier]').each((index, element) => {
        const identifier = $(element).attr('data-identifier');
 
        if (window.localStorage.getItem(identifier) != null) {
            element.textContent = window.localStorage.getItem(identifier);
        } else {
            const [ category, id ] = identifier.split(':');
            $(element).addClass('card');
            $(element).html(`<p>${category}</p><p>${id}</p>`);
        }
    });

    $('#search').keyup(event => {
        if (event.keyCode == 13) {
            event.preventDefault();

            const phrases = new Array(...event.target.value.split(/\s+/))
                .map(phrase => phrase.toLowerCase())
                .filter(phrase => phrase != '');

            let hasResults = false;

            $('.entity').each((index, element) => {
                let hasPhrases = false;

                $(element).children('.property').each((index, property) => {
                    const text = $(property).children('.value').text().toLowerCase();
                    const hasPhrase = phrases.reduce((previous, current) => (previous || text.search(current) != -1), false);
                    
                    hasPhrase ? $(property).addClass('highlight') : $(property).removeClass('highlight');
                    hasPhrases = hasPhrases || hasPhrase;
                });

                hasPhrases = phrases.length != 0 ? hasPhrases : true;
                hasPhrases ? $(element).removeClass('hidden') : $(element).addClass('hidden');
                hasResults = hasResults || hasPhrases;
            });

            hasResults ? $('.no-results').addClass('hidden') : $('.no-results').removeClass('hidden');
        }
    });
});
