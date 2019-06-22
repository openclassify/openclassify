$(document).ready(function () {
    $('select[name="cat1"], select[name="cat2"], select[name="cat3"], ' +
        'select[name="cat4"], select[name="cat5"], select[name="cat6"], select[name="cat7"]').on('change', function () {
        var all = $(this).val();
        $(this).val(all[all.length-1])
    })

    const filter = {};
    filter.getCats = (catId, divId) => {
        console.log(catId,divId)
        $.ajax({
            type: 'get',
            url: '/class/getcats/'+ divId,
            success: function (response) {
                hideLoader()
                if(response['title'] != undefined){
                    var btn = '<button type="submit" class="btn-1">'+response['nextBtn']+'</button>'
                    if(response['link'] != "")
                    {
                        btn = "<a class='btn btn-primary' href='"+response['link']+"' role='button'>"+response['nextBtn']+"</a>";
                    }
                    $('.cat-item-3').html(
                        '<div class="section next-stap post-option">' +
                        '<h2>'+response['title']+'</h2>' +
                        '<p>'+response['msg']+'</p>' +
                        '<div class="btn-section btn-next">' +
                        btn +
                        '<a href="/" class="btn-info">'+response['cancelBtn']+'</a></div></div>'
                    );
                    $('.cat-item-3').show();
                    stop();
                }
                else {
                    response.forEach(function(options){
                        $(catId).append("<option value="+options.id+">"+options.name+"</option>").closest('.cat-item-2').show();
                    });
                }
            },
            beforeSend: function () {
                showLoader()
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
