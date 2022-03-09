phoneMask("input[name='gsm_phone'],input[name='office_phone'],input[name='land_phone']")

$('.new-profile-image').on('click', () => {
    $('#file').parent().find('a').click()
})

//Listen to your custom event
window.addEventListener('uploadedSingleField', function (e) {
    $('.uploaded .btn-success').on('click',function(e){
        e.preventDefault();

        let id_selected = $(this).attr('data-file');
        $.get(REQUEST_ROOT_PATH + '/streams/media-field_type/selected?uploaded=' +id_selected, function(data) {
            let profile_image_preview_url = $('.file-rows-table').html(data).find('img').attr('src');
            $('.profile-image img').attr('src', profile_image_preview_url);
        })
    })
});