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
});
