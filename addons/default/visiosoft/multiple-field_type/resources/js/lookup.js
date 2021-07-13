$(document).on('ajaxComplete ready', function () {

    // Initialize multiple pickers
    $('input[data-provides="visiosoft.field_type.multiple"]:not([data-initialized])').each(function () {

        $(this).attr('data-initialized', '');

        let input = $(this);
        let field = input.data('field_name');
        let wrapper = input.closest('.form-group');
        let modal = $('#' + field + '-modal');

        let selected = $('[name="' + field + '"]').val().split(',');

        modal.on('click', '[data-entry]', function (e) {

            e.preventDefault();

            selected.push(String($(this).data('entry')));

            $('[name="' + field + '"]').val($.unique(selected).join(','));

            $(this).closest('tr').addClass('success').fadeOut();

            wrapper.find('.selected').load(REQUEST_ROOT_PATH + '/streams/v-multiple-field_type/selected/' + $(this).data('key') + '?uploaded=' + selected.join(','), function () {
                wrapper.sort();
            });

            $(wrapper).find('[data-dismiss="multiple"]').removeClass('hidden');
        });

        modal.on('click', '[name="action"][value="add_selected"]', function(e) {

            e.preventDefault();

            $('input[type="checkbox"][data-toggle="action"]:checked').each(function () {
                selected.push(String($(this).val()));
                $(this).closest('tr').addClass('success').fadeOut();
            });

            $('[name="' + field + '"]').val(selected.join(','));

            wrapper.find('.selected').load(
                REQUEST_ROOT_PATH + '/streams/v-multiple-field_type/selected/' + $(this).data('key') + '?uploaded=' + selected.join(','),
                function() {
                    wrapper.sort();
                }
            );
        });

        $(wrapper).on('click', '[data-dismiss="multiple"]', function (e) {

            e.preventDefault();

            selected.splice(selected.indexOf(String($(this).data('entry'))), 1);

            $('[name="' + field + '"]').val(selected.join(','));

            $(this).closest('tr').addClass('danger').fadeOut();
        });

        wrapper.sort = function () {
            wrapper.find('.selected table').sortable({
                nested: false,
                handle: '.handle',
                itemSelector: 'tr',
                itemPath: '> tbody',
                containerSelector: 'table',
                placeholder: '<tr class="placeholder"/>',
                afterMove: function ($placeholder) {

                    $placeholder.closest('table').find('button.reorder').removeClass('disabled');

                    $placeholder.closest('table').find('.dragged').detach().insertBefore($placeholder);

                    selected = [];

                    $(wrapper.find('table').find('[data-dismiss="multiple"]')).each(function () {
                        selected.push(String($(this).data('entry')));
                    });

                    $('[name="' + field + '"]').val(selected.join(','));
                }
            });
        }

        // Sort initially
        wrapper.sort();
    });
});
