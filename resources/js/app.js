import Axios from 'axios';
import Lodash from 'lodash';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.entity label').forEach(element => {
        let identifier = element.getAttribute('for');
        let content = element.textContent;

        if (identifier == null || content == null) {
            console.error('Invalid entity label', element);
        } else {
            if (typeof window.localStorage[identifier] == 'undefined') {
                console.info(`Entity "${identifier}" has been cached with title "${content}"`);
                window.localStorage[identifier] = content;
            }
        }
    });

    document.querySelectorAll('.entity a[data-identifier]').forEach(element => {
        let identifier = element.getAttribute('data-identifier');
        
        if (typeof window.localStorage[identifier] != 'undefined') {
            element.textContent = window.localStorage[identifier];
        } else {
            let [ category, id ] = identifier.split(':');
            element.classList.add('card');
            element.innerHTML = `<p>${category}</p><p>${id}</p>`;
        }
    });


    let searchInput = document.getElementById('search');
    if (searchInput != null) {
        searchInput.addEventListener('keyup', event => {
            if (event.key.toLowerCase() == 'enter') {
                event.preventDefault();

                const searchPhrases = new Array(...searchInput.value.split(/\s+/))
                    .map(phrase => phrase.toLowerCase())
                    .filter(phrase => phrase != '');
                
                document.querySelectorAll('.entity').forEach(entity => {
                    entity.classList.remove('hidden');
                    let hasMatchingProperties = false;

                    entity.querySelectorAll('.property').forEach(property => {
                        const value = property.querySelector('.value').innerText;

                        searchPhrases.forEach(phrase => {
                            if (value.search(phrase) != -1) {
                                hasMatchingProperties = true;
                            }
                        });

                        if (searchPhrases.length == 0) {
                            hasMatchingProperties = true;
                        }
                    });

                    if (!hasMatchingProperties) {
                        entity.classList.add('hidden');
                    }
                });
            }
        });
    }
});
