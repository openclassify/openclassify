function showLoader() {
    $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
}

function hideLoader() {
    $('.loading-cart').remove();
}