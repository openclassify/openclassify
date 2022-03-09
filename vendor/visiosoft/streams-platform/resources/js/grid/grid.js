(function (window, document) {

    let grids = Array.prototype.slice.call(
        document.querySelectorAll('ul.grid--sortable')
    );

    grids.forEach(function (grid) {

        Sortable.create(grid, {
            handle: '.handle',
            draggable: 'tr',
            onUpdate: function () {

                let request = new XMLHttpRequest();

                request.open('POST', window.location.href, true);
                request.setRequestHeader('Content-Type', 'application/json');

                request.send(JSON.stringify({
                    _token: CSRF_TOKEN,
                    items: this.toArray().map(item => item.dataset.id),
                }));
            }
        });
    });
})(window, document);
