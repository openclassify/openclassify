phoneMask("input[name='adress_gsm_phone']")

$('.selectAddress').on('click', function () {
    var id = $(this).attr('data-id')
    var old_selected = $("#my_address").find('.selected');
    old_selected.find("b").html(chooseAddressText);
    old_selected.removeClass('selected')
    $('input[name="address_id"]').val(id);
    $(this).find("b").html(selectedAddressText);
    $(this).addClass('selected');
});

$('.locationSection').on('click', function () {
    var old_selected = $("#my_address").find('.selected');
    old_selected.find("b").html(chooseAddressText);
    old_selected.removeClass('selected')
    $('input[name="address_id"]').val("");
})


//Edit Address Modal Get Field Value
$('.edit-this-address').on('click', function () {
    var edit_address_id = $(this).data('id');

    resetForm();

    //Set Update Form Action
    $("#newAdd-address").attr("action", '/profile/adress/ajaxUpdate/' + edit_address_id);

    //Get Address Detail
    crudAjax({"id": edit_address_id}, '/profile/adress/ajaxDetail', 'POST', function (callback) {
        var address_detail = callback.data;
        var address_field = ['adress_name', 'adress_gsm_phone', 'adress_first_name', 'adress_last_name'];

        //Each Value for Fields
        $.each(address_field, function (index, field) {
            $('input[name="' + field + '"]').val(address_detail[field])
        });

        var iti = intlTelInput(document.querySelector("input[name='adress_gsm_phone']"), {
            setNumber: address_detail.adress_gsm_phone
        })
        $("#newAdd-address").find('textarea[name="adress_content"]').html(address_detail.adress_content)
        $("#newAdd-address").find('select[name="country"]').val(address_detail.country_id)

        //Get City Options
        crudAjax('id=' + address_detail.country_id, '/ajax/getCities', 'POST',function (callback){
            setSelectOptions($("#newAdd-address").find('select[name="city"]'),callback,'id','name');
        })

        //Get District Options
        var selectedCity = new Promise(function (resolve) {
            crudAjax('id=' + address_detail.city, '/ajax/getDistricts', 'POST',function (callback){
                setSelectOptions($("#newAdd-address").find('select[name="district"]'),callback,'id','name');
            });
            $("#newAdd-address").find('select[name="city"]').val(address_detail.city)
            resolve();
        });
        //Selected District
        selectedCity.then(function (categories_list) {
            $("#newAdd-address").find('select[name="district"]').val(address_detail.district)
        })

    })
    //Open Edit Address Modal
    $('#editAddress').modal('show')
})

function resetForm() {
    $("#newAdd-address").trigger("reset");
    $("#newAdd-address").find("textarea").html('');
    $("#newAdd-address").find('select[name="district"]').html('')
}

$("#newAdd-address").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    crudAjax(form.serialize(), url, "POST", function (response) {
        if (response.status == "updated") {
            $('.row-address' + response.data.id).find(".address-title").html(response.data.adress_name)
            $('#editAddress').modal('hide');
            resetForm();
        } else {
            alert(response.msg)
        }
    });
});

function setSelectOptions(input, options, valueParams, TitleParams) {
    input.html("<option value=''>...</option>");
    $.each(options, function (index, value) {
        input.append("<option value='" + value[valueParams] + "'>" + value[TitleParams] + "</option>");
    });
}