$(() => {
    if (buying_selling_title) {
        getCfValue(buying_selling_title)
    }
    var is_buying_selling_title = $('#is_buying_selling_title');
    is_buying_selling_title.on('change', () => {
        if (is_buying_selling_title.val()) {
            getCfValue(is_buying_selling_title.val())
        }
    })
});

function getCfValue(cf) {
    crudAjax(null, `/ajax/get-cf-value/${cf}`, 'GET', function (callback) {
        $('select[name="is_buying_value"]').html("<option value=''>" + pick_option + "</option>");
        $('select[name="is_selling_value"]').html("<option value=''>" + pick_option + "</option>");
        $.each(callback, function (index, value) {
            $('select[name="is_buying_value"]').append(`<option value='${value.id}' ${value.id == is_buying ? 'selected' : ''}>${value.custom_field_value}</option>`)
            $('select[name="is_selling_value"]').append(`<option value='${value.id}' ${value.id == is_selling ? 'selected' : ''}>${value.custom_field_value}</option>`)
        });
    });
}