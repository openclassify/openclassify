function getInput(field) {
    var row = field.parent().parent();
    return $(row).find('.add-cart-quantity-input');
}

//plus
$('.add-cart-upgrade button').on('click', function () {
    var input = getInput($(this));
    updatePrice(input, 'plus')
})

//minus
$('.add-cart-reduce button').on('click', function () {
    var input = getInput($(this));
    updatePrice(input, 'minus')
})

//change
$('.add-cart-quantity-input').on('change', function () {
    var input = getInput($(this));
    updatePrice(input, 'change')
})

function updatePrice(input, type) {
    var ad_id = $(input).attr('data-id');
    var current_quantity = $(input).val();

    productDetail(ad_id, current_quantity, type, function (data) {
        ChangeFieldForResponse(type, data.newPrice, data.newQuantity, data.maxQuantity)
    });

}

function productDetail(id, quantity, type, returnData) {
    if (quantity == 0) {
        quantity = 1;
    }
    $.ajax({
        type: 'POST',
        url: '/ajax/StockControl',
        data: 'id=' + id + '&quantity=' + quantity + '&type=' + type,
        success: function (data) {
            hideLoader()
            returnData(data);
        },
        beforeSend: function () {
            showLoader()
        }
    });
}

function ChangeFieldForResponse(type, price, quantity, maxQuantity) {
    if (parseInt(quantity) == 1) {
        $('.add-cart-reduce button').attr('disabled', true);
    } else {
        $('.add-cart-reduce button').attr('disabled', false);
    }
    if (quantity == maxQuantity) {
        $('.add-cart-upgrade button').attr('disabled', true);
    } else {
        $('.add-cart-upgrade button').attr('disabled', false);
    }
    $('.add-cart-quantity-input').val(parseInt(quantity));
    $('.ad-price b').html(parseInt(price))
}

$('.add-cart-button').on('click', function () {
    var quantity = $('.add-cart-quantity-input').val();
    var id = $('.add-cart-quantity-input').attr('data-id');
    return addCart(id, quantity)
})

function addCart(id, quantity) {
    $.ajax({
        type: 'POST',
        url: '/ajax/addCart',
        data: 'id=' + id + '&quantity=' + quantity,
        success: function (data) {
            if (data.status == "success") {
                var url = window.location.origin;
                window.location.reload();
            } else {
                alert(data.msg);
            }
        },
        beforeSend: function () {
            showLoader()
        }
    });
}