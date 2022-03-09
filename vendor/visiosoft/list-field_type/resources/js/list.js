(function ($) {
    $.fn.extend({
        listfield: function (options) {

            this.defaults = {};

            var settings = $.extend({}, this.defaults, options);

            function makeTemplate(parent) {
                return parent.next('.template').html();
            }

            function removeItem() {

                var $parent = $(this).parents('[data-provides="visiosoft.field_type.list"]');

                if ($parent.children('li').length > 1) {
                    $(this).parents('li').remove();
                }
            }

            function addItem(callback) {
                $(this)
                    .parents('li')
                    .after(
                        makeTemplate($(this).parents('[data-provides="visiosoft.field_type.list"]'))
                    );
            }

            function textareaEnter($parent, callback) {

                var $child = $parent.append(makeTemplate($parent));

                if (callback && typeof(callback) === "function") {
                    callback($child);
                }
            }

            function textareaHandle(e) {

                var code = (e.keyCode ? e.keyCode : e.which);

                if (code === 13) {

                    e.preventDefault();

                    var parent = $(this).parent().parent().parent();

                    textareaEnter(parent, function ($child) {
                        $child.find('input').focus();
                    });

                    return false;
                }
            }

            return this.each(function () {
                $(this).on('click', '.add', addItem);
                $(this).on('click', '.remove', removeItem);
                $(this).on('keydown', 'input', textareaHandle);
            });
        }
    });

    $(function () {
        $('[data-provides="visiosoft.field_type.list"]').listfield();
    });


    $('[data-provides="visiosoft.field_type.list"]').sortable({
        handle: '.handle',
        itemSelector: 'li',
        placeholder: '<li class="placeholder"></li>',
        afterMove: function ($placeholder) {
            $placeholder.closest('ul').find('.dragged').detach().insertBefore($placeholder);
        }
    });

})(jQuery);