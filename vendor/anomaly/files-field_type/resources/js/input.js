$(function() {

    // Initialize file pickers
    $('[data-provides="anomaly.field_type.files"]:not([data-initialized])').each(function () {

        $(this).attr('data-initialized', '');

        let input = $(this);
        let field = input.data('field_name');
        let wrapper = input.closest('.form-group');
        let modal = $('#' + field + '-modal');

        let selected = $('[name="' + field + '"]').val().split(',');

        wrapper.sort = function() {
            wrapper.find('table').sortable({
                handle: '.handle',
                itemSelector: 'tr',
                itemPath: '> tbody',
                containerSelector: 'table',
                placeholder: '<tr class="placeholder"/>',
                afterMove: function($placeholder) {

                    $placeholder.closest('table').find('button.reorder').removeClass('disabled');

                    $placeholder.closest('table').find('.dragged').detach().insertBefore($placeholder);

                    selected = [];

                    $(wrapper.find('table').find('[data-dismiss="file"]')).each(function() {
                        selected.push(String($(this).data('file')));
                    });

                    $('[name="' + field + '"]').val($.unique(selected).join(','));
                }
            });
        };

        wrapper.sort();

        $(wrapper).on('click', '[data-remove="all"]', function(e) {

            e.preventDefault();

            $(wrapper).find('[data-dismiss="file"]').each(function() {
                $(this).click();
            });
        });

        modal.on('click', '[data-file]', function(e) {

            e.preventDefault();

            selected.push(String($(this).data('file')));

            $('[name="' + field + '"]').val(selected.join(','));

            $(this).closest('tr').addClass('success').fadeOut();

            wrapper.find('.selected').load(
                REQUEST_ROOT_PATH + '/streams/files-field_type/selected?uploaded=' + selected.join(','),
                function() {
                    wrapper.sort();
                }
            );
        });

        modal.on('click', '[name="action"][value="add_selected"]', function(e) {

            e.preventDefault();

            $('input[type="checkbox"][data-toggle="action"]:checked').each(function () {
                selected.push(String($(this).val()));
                $(this).closest('tr').addClass('success').fadeOut();
            });

            $('[name="' + field + '"]').val(selected.join(','));

            wrapper.find('.selected').load(
                REQUEST_ROOT_PATH + '/streams/files-field_type/selected?uploaded=' + selected.join(','),
                function() {
                    wrapper.sort();
                }
            );
        });

        $(wrapper).on('click', '[data-dismiss="file"]', function(e) {

            e.preventDefault();

            selected.splice(selected.indexOf(String($(this).data('file'))), 1);

            $('[name="' + field + '"]').val(selected.join(','));

            $(this).closest('tr').addClass('danger').fadeOut();
        });
    });
});
