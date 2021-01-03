$('.categories-list .show-all').on('click', function () {
    $(this).siblings('.hidden-category').toggleClass('hidden')
    $(this).find('a span').toggleClass('hidden')
})
