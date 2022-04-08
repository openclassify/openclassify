$(document).on('ajaxComplete ready shown.bs.tab', function () {

    // Initialize WYSIWYG editors.
    $('textarea[data-provides="anomaly.field_type.wysiwyg"]:not(.hasEditor)').each(function () {

        /**
         * Gather available buttons / plugins.
         */
        let textarea = $(this);

        let buttons = textarea.data('available_buttons');
        let plugins = textarea.data('available_plugins');

        textarea.addClass('hasEditor');

        textarea.redactor({

            element: $(this),

            /**
             * Initialize the editor icons.
             */
            callbacks: {
                init: function () {

                    let icons = {};

                    $.each(buttons, function (k, v) {
                        if (v.icon) {
                            icons[v.button ? v.button : k] = '<i class="' + v.icon + '"></i>';
                        }
                    });

                    $.each(plugins, function (k, v) {
                        if (v.icon) {
                            icons[v.button ? v.button : k] = '<i class="' + v.icon + '"></i>';
                        }
                    });

                    $.each(this.button.all(), $.proxy(function (i, s) {

                        let key = $(s).attr('rel');

                        if (typeof icons[key] !== 'undefined') {
                            let icon = icons[key];
                            let button = this.button.get(key);
                            this.button.setIcon(button, icon);
                        }

                    }, this));
                }
            },

            /**
             * Settings
             */
            script: false,
            structure: true,
            linkTooltip: true,
            cleanOnPaste: true,
            toolbarFixed: false,
            imagePosition: true,
            imageResizable: true,
            breakline: Boolean(textarea.data('breakline')),
            removeNewLines: Boolean(textarea.data('remove_new_lines')),
            imageFloatMargin: '20px',
            removeEmpty: ['strong', 'em', 'p'],

            /**
             * Features
             */
            minHeight: textarea.data('height'),
            placeholder: textarea.attr('placeholder'),
            folders: textarea.data('folders').toString().split(','),
            buttons: textarea.data('buttons').toString().split(','),
            plugins: textarea.data('plugins').toString().split(',')
        });

        textarea.closest('form').on('submit', function () {
            textarea.val(textarea.redactor('code.get'));
        });

        if (textarea.is('[readonly]') || textarea.is('[disabled]')) {
            textarea.redactor('button.disableAll');
            textarea.redactor('core.editor')
                .attr('contenteditable', false);
        }
    });
});
