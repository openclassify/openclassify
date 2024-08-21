$("#catSelectionStepForm").on('click', 'input[type=submit]', function() {
    $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
});

$(document).ready(function () {
    $(document).on('change', 'select[name="cat1"], select[name="cat2"], select[name="cat3"], select[name="cat4"], select[name="cat5"], ' +
        'select[name="cat6"], select[name="cat7"], select[name="cat8"], select[name="cat9"], select[name="cat10"]', function () {
        let divId = $(this).find('option:selected').data('value');
        let catSelectId = $(this).attr('id').substring(3);

        filter.hideCats(Number(catSelectId) + 1);
        filter.getCats("#cat" + (Number(catSelectId) + 1), divId);

        $('#cat' + catSelectId + 'input').val(divId);
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
                            <div class="btn-section btn-next">${btn}</div>
                        `
                    }
                    $('.cat-item-3 .next-content').html(content);
                    $('.cat-item-3').parent().css('display', 'flex');
                    stop();
                } else {
                    $(catId).append(`<option disabled selected="selected">Seçiniz</option>`);
                    response.forEach(function(options){
                        $(catId).append(`<option data-value="${options.id}" value="${options.id}">${options.name}</option>`);
                    });
                    $('.focus-select').removeClass('focus-select');
                    $(catId).closest('.cat-item-2').show().addClass('focus-select')
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
                $('body').append('<div class="loading-cart"><div class="lds-ripple"><div></div><div></div></div></div>');
            }
        })
    };

    filter.hideCats = (num) => {
        var startNo = num;
        var endNo = 9;

        while (startNo <= endNo) {
            $('#cat'+ startNo).html("").closest('.cat-item-2').hide();
            $('.cat-item-3').parent().hide();
            startNo++;
        }
    };
});
