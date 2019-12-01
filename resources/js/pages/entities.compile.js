import $ from 'jquery';
import { storeEntityCardLabels, updateEntityLinks } from '../templates/entity-card.js';

$(document).ready(() => {
    storeEntityCardLabels();
    updateEntityLinks();
});