function showLoader() {
    $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
}

$("#catSelectionStepForm").on('click', 'input[type=submit]', function() {
    $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
});

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
                if(response['title'] != undefined){
                    response['success'] ? $('.post-icon > svg:last-of-type').hide() : $('.post-icon > svg:first-of-type').hide();

                    let btn = '<button type="submit" class="btn-1">'+response['continueBtn']+'</button>';
                    if (response['link']) {
                        const res = response['link']
                        if (Array.isArray(res)) {
                            btn = '';
                            res.forEach(function (link) {
                                btn += `
                                    <input type="submit" data-pack-id="${link.packID}" class="btn-1 mb-2 text-wrap"
                                        value="${response['continueBtn']}` + ' ' + `(${link.price})" />
                                `
                            })
                        } else {
                            btn = "<a class='link-unstyled btn-1 text-white' href='"+res+"' role='button'>"+response['continueBtn']+"</a>";
                        }
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
                    if (!$('li', catId).length) {
                        response.forEach(function(options){
                            $(catId).append("<li class='text-truncate pl-1 my-1' data-value="+options.id+">"+options.name+"</li>");
                        });
                        $('.focus-select').removeClass('focus-select');
                        // $(catId).animate({height: '14rem'}, 200);
                        $(catId).css({height: '14rem'});
                        $(catId).closest('.cat-item-2').show().addClass('focus-select')
                    }
                }
                // Auto scroll right or left
                let categoryTab = $('.category-tab');
                let pos;
                if (isRtl){
                    pos = categoryTab.scrollLeft() - (categoryTab.width() * 2);
                    $('.cat-item-3').css('display', 'flex');
                } else {
                    pos = categoryTab.scrollLeft() + categoryTab.width();
                }
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
            // $('#cat'+ startNo).animate({height: 0}, 200, 'linear', function () {
            //     $(this).html("").closest('.cat-item-2').hide();
            // });
            $('#cat'+ startNo).html("").closest('.cat-item-2').hide();
            $('.cat-item-3').parent().hide();
            startNo++;
        }
    };

    $('.cat-select').on('click', 'li', function () {
        $(this).addClass('selected').siblings().removeClass('selected')
        let divId = $(this).data('value');
        let catSelectId = $(this).closest('.cat-select').attr('id')
        catSelectId = catSelectId.substring(3)

        $(`input[name=cat${catSelectId}]`).val(divId);

        filter.hideCats(Number(catSelectId) + 1);
        filter.getCats("#cat" + (Number(catSelectId) + 1), divId);
    });
});
