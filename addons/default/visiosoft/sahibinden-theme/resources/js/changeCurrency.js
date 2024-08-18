let currency =
    document.cookie.match(new RegExp('(^| )currency=([^;]+)')) ?
        document.cookie.match(new RegExp('(^| )currency=([^;]+)'))[2] :
        defaultCurrency

$(() => {
    $('select[name="currency"]').val(currency)

    let langArray = [];
    $('.vodiapicker option').each(function(){
        let img = $(this).attr("data-thumbnail");
        let text = this.innerText;
        let value = $(this).val();
        let item = '<li class="d-flex ml-2"><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';

        if (value === currency) {
            $('.currency-select .btn-select').html(item);
        }
        langArray.push(item);
    })
    $('#currencies-list').html(langArray);

    $('#currencies-list li').on('click', function(){
        let img = $(this).find('img').attr("src");
        let value = $(this).find('img').attr('value');
        let text = this.innerText;
        let item = '<li class="d-flex ml-2"><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
        $('.currency-select .btn-select').html(item).attr('value', value);
        $('select[name="currency"]').val(value)
        $(".currencies").toggle();
    });

    $(".currency-select .btn-select").on('click', function(){
        $(".currencies").toggle();
    });

    if (currency){
        let langIndex = langArray.indexOf(currency);
        $('.currency-select .btn-select').html(langArray[langIndex]).attr('value', currency);
    } else {
        let langIndex = langArray.indexOf('ch');
        $('.currency-select .btn-select').html(langArray[langIndex]);
    }
})

/* Set Cookie For Currency */
$('.currency-calculate').on('click', () => {
    document.cookie = `currency=${$('select[name="currency"]').val()};max-age=10000;path=/`;
    window.location.reload();
})
