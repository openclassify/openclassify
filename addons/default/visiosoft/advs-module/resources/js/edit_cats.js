function getCats(catId, divId, current = null) {
    if (divId != "") {
        $.ajax({
            type: 'get',
            url: '/ajax/getcats/' + divId,
            success: function (response) {
                if (response.length <= 0) {
                    $('.cat-item-3').show();
                    stop();
                } else {
                    response.forEach(function (options) {
                        $(catId).append("<option value=" + options.id + ">" +
                            options.name + " </option>").closest('.cat-item-2').show();
                    });
                }
            }
        }).promise().done(function () {
            if (current != null)
                $(current).val([divId]);
        })
    }

};

function hideCats(num) {
    var startNo = num;
    var endNo = 6;

    while (startNo <= endNo) {
        $('#cat' + startNo).html("").closest('.cat-item-2').hide();
        $('.cat-item-3').hide();
        startNo++;
    }
};


jQuery(document).ready(function ($) {
    $('select[name="cat1"], select[name="cat2"], select[name="cat3"], ' +
        'select[name="cat4"], select[name="cat5"], select[name="cat6"], select[name="cat7"]').on('change', function () {
        var all = $(this).val();
        var data_level = $(this).attr('data-level');
        $(this).val(all[all.length - 1])
        divId = $(this).find('option:selected').val();
        if (divId == 0) {
            hideCats(parseInt(data_level) + 1);
        }
        hideCats(parseInt(data_level) + 1);
        getCats("#cat" + (parseInt(data_level) + 1), divId);


    });
});
jQuery(document).promise().done(function () {
    level = 1;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 2;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 3;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 4;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 5;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 6;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
}).promise().done(function () {
    level = 7;
    getCats("#cat" + (level + 1), $("#cat" + level).attr('data-value'), "#cat" + level);
});