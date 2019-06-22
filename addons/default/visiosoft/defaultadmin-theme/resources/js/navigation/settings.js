$(function () {

    /**
     * Allow reordering the navigation.
     */
    $('#sidebar').find('> ul').sortable({
        nested: false,
        placeholder: '<li class="placeholder"/>',
        afterMove: function ($placeholder) {
            $placeholder.closest('ul').find('.dragged').detach().insertBefore($placeholder);
        },
        onDrop: function ($item, container, _super) {

            let navigation = [];

            $('#sidebar').find('> ul > li').each(function () {
                navigation.push(String($(this).data('slug')));
            });

            $('#navigation-order').val(JSON.stringify(navigation));

            _super($item, container);
        }
    });
});
