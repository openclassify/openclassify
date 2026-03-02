$('#navbarSideButton').on('click', function() {
    $('#navbarSide').addClass('reveal');
    $('.overlay').css({'z-index': 999}).show();
});
$('.overlay').on('click', function(){
    $('#navbarSide').removeClass('reveal');
    $('.overlay').css({'z-index': 'initial'}).hide();
});
