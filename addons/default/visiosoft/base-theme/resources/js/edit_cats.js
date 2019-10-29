$(document).ready(function () {
    $('select[name="cat1"], select[name="cat2"], select[name="cat3"], ' +
        'select[name="cat4"], select[name="cat5"], select[name="cat6"], select[name="cat7"]').on('change', function () {
        var all = $(this).val();
        $(this).val(all[all.length-1])
    })

    const filter = {};
    filter.getCats = (catId, divId) => {
        $.ajax({
            type: 'get',
            url: '/ajax/getcats/'+ divId,
            success: function (response) {
                if(response.length <= 0){
                    $('.cat-item-3').show();
                    stop();
                }
                else {
                    response.forEach(function(options){
                        $(catId).append("<option value="+options.id+">"+options.name+"</option>").closest('.cat-item-2').show();
                    });
                }
            }
        })
    };

    filter.hideCats = (num) => {
        var startNo = num;
        var endNo = 6;

        while (startNo <= endNo) {
            $('#cat'+ startNo).html("").closest('.cat-item-2').hide();
            $('.cat-item-3').hide();
            startNo++;
        }
    };

    for (var i = 1; i <= 6; i++) {
        (function(){
            var ii = i;
            $('#cat'+i).on('change', function (i,e) {
                divId = $(this).find('option:selected').val();
                if (divId == 0) {
                    filter.hideCats(ii+1);
                }
                filter.hideCats(ii+1);
                filter.getCats("#cat"+(ii+1), divId);
            });
        })();
    }

});