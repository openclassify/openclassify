(function (window, document) {

    let tables = Array.prototype.slice.call(
        document.querySelectorAll('table.table--sortable')
    );

    tables.forEach(function (table) {

        let reorder = table.querySelector('.table__actions button.reorder');

        Sortable.create(table.querySelector('tbody'), {
            handle: '.handle',
            draggable: 'tr',
            onUpdate: function () {
                if (reorder) {
                    reorder.removeAttribute('disabled');
                    reorder.classList.remove('disabled');
                }
            }
        });
    });
})(window, document);
