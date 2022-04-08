$(function () {

    var repeaters = $('[data-provides="anomaly.field_type.repeater"]:not([data-initialized])');

    repeaters.each(function () {

        $(this).attr('data-initialized', '');

        var wrapper = $(this);
        var instance = $(this).data('instance');
        var items = $(this).find('.repeater-item');
        var add = wrapper.find('.add-row[data-instance="' + instance + '"]');
        var cookie = 'repeater:' + $(this).closest('.repeater-container').data('field_name');

        var collapsed = Cookies.getJSON(cookie);

        items.each(function () {

            var item = $(this);
            var toggle = $(this).find('[data-toggle="collapse"]');
            var text = toggle.find('span');

            /**
             * Hide initial items.
             */
            if (typeof collapsed == 'undefined') {
                collapsed = {};
            }

            if (collapsed[items.index(item)] == true) {
                item
                    .toggleClass('collapsed')
                    .find('[data-toggle="collapse"] i')
                    .toggleClass('fa-compress')
                    .toggleClass('fa-expand');

                if (toggle.find('i').hasClass('fa-compress')) {
                    text.text(toggle.data('collapse'));
                } else {
                    text.text(toggle.data('expand'));
                }
            }
        });

        wrapper.on('dblclick', '.repeater-item-controls', function () {
            $(this).find('[data-toggle="collapse"]:first').trigger('click');
        });

        wrapper.on('click', '[data-toggle="collapse"]', function () {

            if (typeof collapsed == 'undefined') {
                collapsed = {};
            }

            // Stash the action.
            var action = $(this).find('i').hasClass('fa-expand') ? 'expanding' : 'collapsing';

            // Check this row.
            $(this).closest('.repeater-item').find('input[type="checkbox"]:first').prop('checked', true);

            // Hide the dropdown menu.
            $(this).closest('.repeater-item').find('.dropdown:first .open').removeClass('open');

            wrapper.find('.repeater-item').each(function () {

                var item = $(this);
                var toggle = item.find('[data-toggle="collapse"]');
                var checkbox = item.find('input[type="checkbox"]:first');
                var text = toggle.find('span');

                if (action == 'collapsing' && item.hasClass('collapsed')) {
                    checkbox.prop('checked', false);
                }

                if (action == 'expanding' && !item.hasClass('collapsed')) {
                    checkbox.prop('checked', false);
                }

                if (checkbox.prop('checked')) {
                    item
                        .toggleClass('collapsed')
                        .find('[data-toggle="collapse"] i')
                        .toggleClass('fa-compress')
                        .toggleClass('fa-expand');

                    if (toggle.find('i').hasClass('fa-compress')) {
                        text.text(toggle.data('collapse'));
                    } else {
                        text.text(toggle.data('expand'));
                    }

                    toggle
                        .closest('.dropdown')
                        .find('.dropdown-toggle')
                        .trigger('click');

                    checkbox.prop('checked', false);

                    collapsed[items.index(item)] = item.hasClass('collapsed');
                }
            });

            Cookies.set(cookie, JSON.stringify(collapsed), {path: window.location.pathname});

            return false;
        });

        wrapper.on('click', '[data-delete="row"]', function () {

            // Check this row.
            $(this).closest('.repeater-item').find('input[type="checkbox"]:first').prop('checked', true);

            // Hide the dropdown menu.
            $(this).closest('.repeater-item').find('.dropdown:first .open').removeClass('open');

            wrapper.find('.repeater-item').each(function () {

                var item = $(this);
                var checkbox = item.find('input[type="checkbox"]:first');

                if (checkbox.prop('checked')) {
                    item.remove();
                }
            });

            return false;
        });

        wrapper.on('click', '[data-select="all"]', function () {

            wrapper.find('.repeater-item').each(function () {

                var item = $(this);
                var checkbox = item.find('input[type="checkbox"]:first');

                if (!checkbox.prop('checked')) {
                    checkbox.prop('checked', true);
                }
            });

            return false;
        });

        wrapper.on('click', '[data-add="above"]', function () {

            wrapper.find('.repeater-item.target').removeClass('target');

            $(this).closest('.repeater-item').addClass('target');

            wrapper.find('> .repeater-controls > a.add-row').trigger('click');

            return false;
        });

        wrapper.indexCollapsed = function () {

            wrapper.find('.repeater-list').find('.repeater-item').each(function (index) {

                var item = $(this);

                if (typeof collapsed == 'undefined') {
                    collapsed = {};
                }

                collapsed[index] = item.hasClass('collapsed');

                Cookies.set(cookie, JSON.stringify(collapsed), {path: window.location.pathname});
            });
        };

        wrapper.sort = function () {
            wrapper.find('> .repeater-list').sortable({
                handle: '.repeater-handle',
                placeholder: '<div class="placeholder"></div>',
                containerSelector: '.repeater-list',
                itemSelector: '.repeater-item',
                nested: false,
                onDragStart: function ($item, container, _super, event) {

                    $item.css({
                        height: $item.outerHeight(),
                        width: $item.outerWidth()
                    });

                    $item.addClass('dragged');

                    adjustment = {
                        left: container.rootGroup.pointer.left - $item.offset().left,
                        top: container.rootGroup.pointer.top - $item.offset().top
                    };

                    _super($item, container);
                },
                onDrag: function ($item, position) {
                    $item.css({
                        left: position.left - adjustment.left,
                        top: position.top - adjustment.top
                    });
                },
                afterMove: function ($placeholder) {

                    $placeholder.closest('.repeater-list').find('.dragged').detach().insertBefore($placeholder);

                    wrapper.indexCollapsed();
                },
                serialize: function ($parent, $children, parentIsContainer) {

                    var result = $.extend({}, $parent.data());

                    if (parentIsContainer)
                        return [$children];
                    else if ($children[0]) {
                        result.children = $children[0]; // This needs to return [0] for some reason..
                    }

                    delete result.subContainers;
                    delete result.sortable;

                    return result
                }
            });
        };

        wrapper.sort();

        add.click(function (e) {

            e.preventDefault();

            var count = wrapper.find('.repeater-item').length + 1;

            var $repeaterItem = $('<div class="repeater-item"><div class="repeater-loading">' + $(this).data('loading') + '...</div></div>');

            var target = $(wrapper).find('> .repeater-list > .repeater-item.target');

            if (target.length) {
                target.removeClass('target').before($repeaterItem);
            } else {
                $(wrapper).find('> .repeater-list').first().append($repeaterItem);
            }

            $.get($(this).attr('href') + '&instance=' + count, function (data) {

                /**
                 * This is a hack to get around a bug that exists in the editor field type.
                 * If ace has already been loaded then search for a line containing ace.js and remove it.
                 */
                if (typeof(ace) === 'object') {
                    var dataArray = data.split('\n');
                    var removeIndex = -1;
                    for (var i = 0; i < dataArray.length; i++) {
                        if (dataArray[i].includes('ace.js')) {
                            removeIndex = i;
                        }
                    }
                    if (removeIndex > -1) {
                        dataArray.splice(removeIndex, 1);
                    }

                    data = dataArray.join('\n');
                }

                $repeaterItem.html(data);

                $('html, body').animate({
                    scrollTop: $repeaterItem.offset().top - 140
                }, 200);

                wrapper.sort();
                wrapper.indexCollapsed();
            });
        });
    });
});
