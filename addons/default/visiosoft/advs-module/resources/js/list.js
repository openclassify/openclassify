var filter = {};

filter.checkUser = () => {
    $.ajax({
        type: 'get',
        url: '/check_user',
        success: function (response) {
            if (response.success == true) {
                $('#search-fav-modal').modal('toggle');
            } else {
                window.location.replace("/login");
            }
        },
        error: function (err) {
            reject(Error("It broke"));
        }
    });
};

$('.sort-by-item').on('click', function () {
    let searchParams = new URLSearchParams(window.location.search);
    var sort_by = searchParams.get('sort_by');
    var url = window.location.href;
    if (url.slice(-1) === "#") {
        url = url.slice(0, -1);
    }
    var goURL = "";
    var value = $(this).attr('data-value');
    if (window.location.search == "") {
        goURL = url + "?sort_by=" + value;
    } else if (searchParams.has('sort_by')) {
        var parameters = "";
        if (value != 'all') {
            parameters = "sort_by=" + value;
        }
        goURL = location.href.replace("sort_by=" + sort_by, parameters);
    } else {
        goURL = url + "&sort_by=" + value;
    }
    window.location.replace(goURL);
});

$(document).ready(function () {
    let searchParams = new URLSearchParams(window.location.search);

    var checked = $('.cf-li-item input:checked');
    checked.each(function (index, option) {
        var elementName = ".span" + option.value;
        var name = $(elementName).html();
        $('.category-tabs').append('<button value="' + elementName + '" class="btn btn-success cat-tab">' + name + '</button>\n')
    });

    $("#min-price").val(searchParams.get('min-price'));
    $("#max-price").val(searchParams.get('max-price'));


    var sort_by = searchParams.get('sort_by');

    if (sort_by != null) {
        $('.sort-by-selected-text').html($('.sort-by-item[data-value=' + sort_by + ']').html());
    }


    $('#approved').on('click', function () {
        var id = $(this).val();
        var type = $(this).attr('id');
        $.ajax({
            type: 'get',
            url: '/admin/class/actions/' + id + "," + type,
            success: function (response) {
                $('#approved').html("Onaylandi");
                $('#declined').html('Reddet');
            },
            beforeSend: function () {
                showLoader()
            },
            error: function (err) {
                reject(Error("It broke"));
            }
        });
    });
    $('#declined').on('click', function () {
        var id = $(this).val();
        var type = $(this).attr('id');
        $.ajax({
            type: 'get',
            url: '/admin/class/actions/' + id + "," + type,
            success: function (response) {
                $('#declined').html('Reddedildi');
                $('#approved').html('Onayla');
            },
            beforeSend: function () {
                showLoader()
            },
            error: function (err) {
                reject(Error("It broke"));
            }
        });
    });
    $('#passive').on('click', function () {
        var id = $(this).val();
        var type = $(this).attr('id');
        $.ajax({
            type: 'get',
            url: '/admin/class/actions/' + id + "," + type,
            success: function (response) {
                $('#declined').html('Reddet');
                $('#approved').html('Onayla');
                $('#passive').html('Aktif Et').attr('id', 'pending_admin');
            },
            beforeSend: function () {
                showLoader()
            },
            error: function (err) {
                reject(Error("It broke"));
            }
        });
    });
    $('#pending_admin').on('click', function () {
        var id = $(this).val();
        var type = $(this).attr('id');
        $.ajax({
            type: 'get',
            url: '/admin/class/actions/' + id + "," + type,
            success: function (response) {
                $('#declined').html('Reddet');
                $('#approved').html('Onayla');
                $('#pending_admin').html('Pasif Et').attr('id', 'passive');
            },
            beforeSend: function () {
                showLoader()
            },
            error: function (err) {
                reject(Error("It broke"));
            }
        });
    });
    $('.cat-tab').on('click', function () {
        var value = $(this).val();
        $(value).prev('input').prop('checked', false);
        $(this).hide();
    });

    $('#save-search').on('click', function () {
        filter.checkUser();
    });

    $('.filter-box>div:first-child').on('click', function () {
        $(this).siblings().toggleClass('d-none');
    })

    // Country filter
    const locationFilter = $("select[name=filter_country]")
    locationFilter.select2({
        placeholder: $('select[name=filter_country] option:first-child').text()
    });
    locationFilter.change(function () {
        if ($(this).val()) {
            getCities($(this).val())
        }
    }).trigger('change');

    // City filter
    $("select[name=filter_City]").select2({
        placeholder: $('select[name=filter_City] option:first-child').text()
    });

    $('.filter-form-reset').on('click', function () {
        let form = $("#listFilterForm");
        form.find('input:text, input:password, input:file, input[type="number"], select, textarea').val('');
        form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        form.submit();
    });
});

function getCities(country) {
    return crudAjax(`id=${country}`, '/ajax/getCities', 'POST', () => {
    }, true)
        .then(function (cities) {
            $('select[name="filter_City"]').html("<option value=''>" + $('select[name=filter_City] option:first-child').text() + "</option>");
            $.each(cities, function (index, value) {
                $('select[name="filter_City"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
            });
        })
}

$("#listFilterForm, #listFilterFormMobile").submit(function (e) {
    // Disable unselected inputs
    const inputs = $('#' + $(this).attr('id') + ' :input');

    [...inputs].forEach((input) => {
        if (input.type === 'checkbox' || input.type === 'radio') {
            if ($(input).prop("checked") == false) {
                $(input).prop('disabled', true);
            }
        } else {
            if ($(input).val() == "" || $(input).find(':selected').val() == "") {
                $(input).prop('disabled', true);
            }
        }
    });

    // Disable country if city is selected
    if ($('#listCityFilter').val()) {
        $('#listCountryFilter').prop('disabled', true)
    }
});

// Change view type
function changeViewType(viewLink) {
    window.location.href = viewLink
}
