(function (window, document) {

    let tables = Array.prototype.slice.call(
        document.querySelectorAll('table.table')
    );

    tables.forEach(function (table) {

        let toggle = table.querySelector('input[data-toggle="all"]');

        if (!toggle) {
            return;
        }

        let checkboxes = Array.prototype.slice.call(
            table.querySelectorAll('input[type="checkbox"][data-toggle="action"]')
        );

        let actions = Array.prototype.slice.call(
            table.querySelectorAll('.table__actions > button, .table__actions > a')
        );

        /**
         * Actions that fire modals should
         * not submit the table on click.
         */
        actions.forEach(function (action) {
            if (action.hasAttribute('href') && action.tagName == 'A') {
                action.addEventListener('click', function () {

                    let checked = checkboxes.filter(function (checkbox) {
                        return checkbox.checked === true;
                    });

                    checked = checked.map(item => item.value).join(',');

                    action.href += (action.href.indexOf('?') > -1) ? '&selected=' + checked : '?selected=' + checked;
                });
            }
        });

        /**
         * If the toggle all checkbox is
         * clicked then toggle imprint it's
         * checked status on ALL action toggles.
         * @type {Element}
         */
        toggle.addEventListener('change', function (event) {
            checkboxes.forEach(function (checkbox) {

                checkbox.checked = event.target.checked;

                checkbox.dispatchEvent(new Event('change'));
            });
        });

        /**
         * Enable and disable the table
         * actions based on the toggles.
         */
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {

                let checked = checkboxes.filter(function (checkbox) {
                    return checkbox.checked === true;
                });

                if (checked.length) {
                    actions.forEach(function (action) {

                        if (action.hasAttribute('data-ignore')) {
                            return;
                        }

                        action.removeAttribute('disabled');
                        action.classList.remove('disabled');
                    });
                } else {
                    actions.forEach(function (action) {

                        if (action.hasAttribute('data-ignore')) {
                            return;
                        }

                        action.setAttribute('disabled', 'disabled');
                        action.classList.add('disabled');
                    });
                }
            });
        });
    });
})(window, document);
