(function (window, document) {

    let dashboard = document.getElementById('dashboard');

    let columns = Array.prototype.slice.call(
        dashboard.querySelectorAll('.column')
    );

    /**
     * Callback function to update the
     * columns / IDs position on sort.
     * @param columns
     */
    const update = function (columns) {

        let request = new XMLHttpRequest();

        request.open('POST', APPLICATION_URL + '/admin/dashboard/widgets/save', true);
        request.setRequestHeader('Content-Type', 'application/json');

        request.send(JSON.stringify({
            _token: CSRF_TOKEN,
            columns: JSON.stringify(
                columns.map(column => column.sortable.toArray())
            ),
        }));
    };

    /**
     * Initialize each column
     * as it's own sortable group.
     */
    columns.forEach(function (column) {

        column.sortable = Sortable.create(column, {
            handle: '.handle',
            group: 'dashboard',
            draggable: '.widget',
            onEnd: function () {
                update(columns);
            },
        });
    });

})(window, document);
