const filter = {};

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