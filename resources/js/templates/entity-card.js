import $ from 'jquery';

const storeEntityCardLabels = () => {
    $('.entity-card label').each((index, element) => {
        const identifier = $(element).attr('for');
        const description = $(element).text();
        window.localStorage.setItem(identifier, description);
    });
};

const updateEntityLinks = () => {
    $('a[data-entity-identifier]').each((index, element) => {
        const identifier = $(element).data('entity-identifier');
        const description = window.localStorage.getItem(identifier);

        if (description != null) {
            $(element).text(() => description);
            $(element).removeClass('badge');
        }
    });
};

export { storeEntityCardLabels, updateEntityLinks };
