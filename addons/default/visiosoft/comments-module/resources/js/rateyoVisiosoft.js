var rate = $('input[name="showRate"]');

$("#rating").rateYo({
    numStars: 5,
    starWidth: "12px",
    precision: 0,
    rating: "100%",
    spacing: "3px",

    onSet: function (rating) {
        $('input[name="rating"]').val(rating)
    }
});

rate.each((key, val)=>{
    let item = $('#' + val.id)

    $(".showRate-" + item.data('id')).rateYo({
        numStars: 5,
        starWidth: "12px",
        precision: 0,
        rating: item.val() + '%',
        spacing: "3px",
        readOnly: true,
    })
});

$(".rating-ads").each(function () {
    $(this).rateYo({
        numStars: 5,
        starWidth: "12px",
        precision: 0,
        readOnly: true,
        rating: $(this).attr('data-ratingVal'),
        spacing: "3px",
    });
});
