$('.add-fav').on('click', function () {
    $('.my-fav-list').html('')

    crudAjax({}, '/favs/myfavs/5', 'POST', function (callback) {
        $.each(callback, function (key, value) {
            $('.my-fav-list').append(`
                <li class="small d-flex align-items-center my-1">
                    <img class="mx-1" src="${value.ad.thumbnail}" />
                    <p>${value.item_name}</p>
                </li>`);
        });
    });
});
