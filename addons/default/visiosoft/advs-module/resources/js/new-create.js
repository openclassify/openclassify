function showLoader() {
    $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
}

function hideLoader() {
    $('.loading-cart').remove();
}


var filter = {};

// TODO will be unified


filter.getCats = (catId, divId) => {
    $.ajax({
        type: 'get',
        url: '/class/getcats/'+ divId,
        success: function (response) {
            hideLoader()
            if(response == 0){
                stop();
            }
            else {
                response.forEach(function(options){
                    $(catId).append("<option value="+options.id+">"+options.name+"</option>");
                    $(catId).closest('li').show();
                });
            }
        },
        beforeSend: function () {
            showLoader()
        }
    })
};

$(document).ready(function () {
    $("select[name='currency']").val(default_currency);
    if(default_GET == 1)
    {
        $('#is_get_adv').prop('checked', true);
    }
});

$(document).on('change', '.sub_cats', function(){
    divId = $(this).find('option:selected').val();
    if (divId == 0) {
        $(this).parent().nextAll().remove();
    } else
        filter.callCats(divId);
});
function getAdv(){
    if (document.getElementById('getMethod').checked){
        var val = $('input[name=price]').val();
        val = val*90/100;
        $("#priceLi").append('<input type="number" class="form-control" disabled id="getprice" value="'+val+'">');
    } else {
        $("#getprice").remove();
    }
}
$('input[name=price]').bind('keyup change', function () {
    var val = $('input[name=price]').val();
    val = val*90/100;
    $("#getprice").val(val);
});



$('input[name="price"]').on('click', function () {
    if($(this).val() == "0.00")
    {
        $(this).val("");
    }
})

$(document).ready(function () {

    $('input[data-provides="anomaly.field_type.slug"]:not([data-initialized])').each(function () {

        $(this).attr('data-initialized', '');

        var config = {
            slug: this,
            lowercase: $(this).data('lowercase')
        };

        /**
         * Only slugify other fields if
         * value is empty OR configured
         * to always slugify field values.
         */
        if (!$(this).val() || $(this).data('always_slugify')) {
            config.slugify = '[data-field="' + $(this).data('slugify') + '"]:visible:first';
        }

        // Slugify slug inputs.
        $(this).slugify(config);
    });

    // Initialize WYSIWYG editors.
    $('textarea[data-field="advs_desc"]:not(.hasEditor)').each(function () {

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

                    $.each([buttons, plugins], function (k, v) {
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