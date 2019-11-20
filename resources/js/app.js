import Axios from 'axios';
import Lodash from 'lodash';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.entites .entity').forEach(element => {
        element.querySelector('.title').addEventListener('click', event => {
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });
    });
});
