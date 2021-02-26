function showLoader() {
    $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
}




var filter = {};

// TODO will be unified


filter.getCats = (catId, divId) => {
    $.ajax({
        type: 'get',
        url: '/class/getcats/' + divId,
        success: function (response) {
            if (response == 0) {
                stop();
            } else {
                response.forEach(function (options) {
                    $(catId).append("<option value=" + options.id + ">" + options.name + "</option>");
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
    if ($('input[name="slug"]').val() == "") {
        $("select[name='currency']").val(default_currency);
    }

    if (default_GET == 1) {
        $('#is_get_adv').prop('checked', true);
    }
});

$(document).on('change', '.sub_cats', function () {
    divId = $(this).find('option:selected').val();
    if (divId == 0) {
        $(this).parent().nextAll().remove();
    } else
        filter.callCats(divId);
});

function getAdv() {
    if (document.getElementById('getMethod').checked) {
        var val = $('input[name=price]').val();
        val = val * 90 / 100;
        $("#priceLi").append('<input type="number" class="form-control" disabled id="getprice" value="' + val + '">');
    } else {
        $("#getprice").remove();
    }
}

$('input[name=price]').bind('keyup change', function () {
    var val = $('input[name=price]').val();
    val = val * 90 / 100;
    $("#getprice").val(val);
});


$('input[name="price"]').on('click', function () {
    if ($(this).val() == "0.00") {
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

$(document).ready(function () {
    $(".priceField, .standard-price-field").inputmask('currency', {
        rightAlign: true,
        prefix: "",
        'groupSeparator': '.',
        'autoGroup': true,
        'digits': 0,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        'placeholder': '0'

    });

    $(".priceDecimalField, .standard-price-decimal-field").inputmask('99', {
        rightAlign: true,
        prefix: "",
        autoUnmask: true,
        allowPlus: false,
        allowMinus: false,
        placeholder: "00"

    });

    $(".decimal-price, .whole-price").on('change', function (e) {
        const parent = e.target.closest('.select-price')
        let price = $(parent).find('.whole-price').val() === "" ? '0' : $(parent).find('.whole-price').val();
        price = parseInt(price.replace(/\./g, ''));
        let decimal = parseInt($(parent).find('.decimal-price').val());

        const newPrice = parseFloat(price + "." + decimal)
        let priceInput = $(parent).find('input[type=number]')
        priceInput.val(newPrice);

        if (priceInput[0].name === 'price') {
            const event = new CustomEvent('priceChangedEvent', {
                detail: {
                    newPrice
                }
            })
            document.querySelector('#price').dispatchEvent(event)
        }
    });

    // Add dynamic option creation
    $(".options-tags").select2({
        tags: true,
        tokenSeparators: [',']
    });

    let deletedOptions = [];
    $('#selectOptions').on('select2:unselect', function (e) {
        if (e.params.data.element.id) {
            const id = e.params.data.element.id.substr(9);
            deletedOptions.push(id);
        } else {
            let index = newOptions.indexOf(e.params.data.text);
            if (index > -1) {
                newOptions.splice(index, 1);
            }
        }
    });

    let newOptions = [];
    $('#selectOptions').on('select2:select', function (e) {
        if (e.params.data.element) {
            let index = deletedOptions.indexOf(e.params.data.element.id.substr(9));
            if (index > -1) {
                deletedOptions.splice(index, 1);
            }
        } else {
            newOptions.push(e.params.data.text)
        }
    });

    $('#createEditAdvForm').submit(function () {
        $(this).append(`<input type="hidden" name="deleted_options" value="${deletedOptions}" />`);

        $(this).append(`<input type="hidden" name="new_options" value="${newOptions}" />`);

        return true;
    })
});
