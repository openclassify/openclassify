function showLoader() {
    $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
}

function hideLoader() {
    $('.loading-cart').remove();
}

$(document).ready(function () {
    $('select[name="cat1"], select[name="cat2"], select[name="cat3"], select[name="cat4"], select[name="cat5"], ' +
        'select[name="cat6"], select[name="cat7"], select[name="cat8"], select[name="cat9"], select[name="cat10"]')
        .on('change', function () {
        var all = $(this).val();
        $(this).val(all[all.length-1])
    });

    var filter = {};
    filter.getCats = (catId, divId) => {
        $.ajax({
            type: 'get',
            url: '/class/getcats/'+ divId,
            success: function (response) {
                hideLoader();
                if(response['title'] != undefined){
                    response['success'] ? $('.cross-icon').hide() : $('.check-icon').hide();

                    let btn = '<button type="submit" class="btn-1">'+response['continueBtn']+'</button>';
                    if (response['link']) {
                        btn = "<a class='link-unstyled btn-1 text-white' href='"+response['link']+"' role='button'>"+response['continueBtn']+"</a>";
                    }
                    let content;
                    if (response['msg']) {
                        content = `
                            <p class="mb-1 mt-2">${response['title']}</p>
                            <small class="text-muted">${response['msg']}</small>
                            <div class="mt-3 btn-section btn-next">${btn}</div>
                        `
                    } else {
                        content = `
                            <p class="mb-3 mt-2">${response['title']}</p>
                            <div class="btn-section btn-next">${btn}</div>
                        `
                    }
                    $('.cat-item-3 .next-content').html(content);
                    $('.cat-item-3').parent().css('display', 'flex');
                    stop();
                } else {
                    response.forEach(function(options){
                        $(catId).append("<option class='text-truncate pl-1 my-1' value="+options.id+">"+options.name+"</option>");
                    });
                    $('.focus-select').removeClass('focus-select');
                    $(catId).animate({height: '14rem'}, 200);
                    $(catId).closest('.cat-item-2').show().addClass('focus-select')
                }
                // Auto scroll right
                let categoryTab = $('.category-tab');
                let pos = categoryTab.scrollLeft() + categoryTab.width();
                categoryTab.animate( {scrollLeft: pos}, 1000);
            },
            beforeSend: function () {
                showLoader()
            }
        })
    };

    filter.hideCats = (num) => {
        var startNo = num;
        var endNo = 9;

        while (startNo <= endNo) {
            $('#cat'+ startNo).animate({height: 0}, 200, 'linear', function () {
                $(this).html("").closest('.cat-item-2').hide();
            });
            $('.cat-item-3').parent().hide();
            startNo++;
        }
    };

    for (var i = 1; i <= 10; i++) {
        (function(){
            var ii = i;
            $('#cat' + i).on('change', function (i, e) {
                let selectedOption = $(this).find('option:selected');
                let divId = selectedOption.val();
                if (divId == 0) {
                    filter.hideCats(ii + 1);
                }
                filter.hideCats(ii + 1);
                filter.getCats("#cat" + (ii + 1), divId);
            });
        })();
    }
});
