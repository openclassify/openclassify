var current_page = 1;
var ads_type = "";

var objJson = [];
let totalAdvs = 0

$('#multiple_advs').submit(function() {
    $('input[name="check[]"]:checked').each(function() {
        $('<input>').attr({
            type: 'hidden',
            name: 'check[]',
            value: $(this).val()
        }).appendTo('#multiple_advs');
    });
});


function prevPage() {
    if (current_page > 1) {
        current_page--;
        getMyAdvs(ads_type)
    }
}

function nextPage(event) {
    if (current_page < numPages()) {
        current_page++;
        getMyAdvs(ads_type)
    }
}

function changePage(page) {

    var btn_next = $("#btn_next");
    var btn_prev = $("#btn_prev");
    if (ads_type == 'approved') {
        var listing_table =  $("#v-pills-active_ads");
    } else if (ads_type == 'pending') {
        var listing_table = $("#v-pills-pending_ads");

    } else if (ads_type == 'passive') {
        var listing_table = $("#v-pills-passive_ads");

    } else if (ads_type == 'incomplete') {
        var listing_table = $("#v-pills-incomplete_ads");
    }
    listing_table.html('');
    var page_span = $("#page");

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();


    if (objJson.length === 0) {
        listing_table.html(`
            <div class="alert alert-warning" role="alert">
                ${no_ads_message}
            </div>
        `);
        $('.action-wrapper').addClass('d-none');
        $('.profile_ads_pagination').addClass('d-none');
    }

    for (var i = 0; i < objJson.length; i++) {
        listing_table.append(addAdsRow(objJson[i].id, objJson[i].detail_url, objJson[i].cover_photo, objJson[i].name,
            objJson[i].formatted_price, objJson[i].city_name, objJson[i].country_name, objJson[i].cat1_name,
            objJson[i].cat2_name, objJson[i].status, objJson[i].created_at, objJson[i].ad_note));
    }

    addDropdownBlock();


    page_span.html(page + "/" + numPages());

    if (numPages() === 1) {
        page_span.hide();
    } else {
        page_span.show();
    }

    if (page === 1) {
        btn_prev.hide();
    } else {
        btn_prev.show();
    }

    if (page === numPages()) {
        btn_next.hide();
    } else {
        btn_next.show();
    }
}

function numPages() {
    return Math.ceil(totalAdvs / records_per_page);
}

function getMyAdvs(type,keyword = null) {
    crudAjax({
        'type': type,
        'paginate': true,
        'page': current_page,
        'simple': true,
        'keyword' : keyword,
        'currencyOptions' : {
            separator: '.',
            point: ','
        },
    }, '/ajax/getAdvs', 'GET', function (callback) {
        ads_type = type;
        objJson = callback.content.data;
        totalAdvs = callback.content.total;
        changePage(current_page);
    })
}

function printAdProfile(id){
    crudAjax(
        {},
        '/ajax/print-detail-view/' + id,
        'GET',
        function (callback) {
        if(callback.length > 0){
            $('#printDivHidden').html(callback);
            printAd();
        }
    })
}


$('#v-pills-tab a').on('click', function () {
    let data_type = $(this).attr('data-type');
    getData(data_type);
});
$('#search-btn').on("click", function (){
    let data_type = $('#v-pills-tab a[aria-selected="true"]').attr('data-type');
    getData(data_type,$('input.form-control').val());
})

function getData(data_type,keyword=null){
    current_page = 1
    let type = data_type;
    $('.profile_ads_pagination').removeClass('d-none');
    $('.action-wrapper').removeClass('d-none');
    if (type == 'active_ads') {
        getMyAdvs("approved", keyword);
    } else if (type == 'passive_ads') {
        getMyAdvs("passive", keyword);
    } else if (type == 'pending_ads') {
        getMyAdvs("pending", keyword);
    } else if (type == 'incomplete_ads') {
        getMyAdvs("incomplete", keyword);
    }
}




addDropdownBlock();


function addAdsRow(id, href, image, name, formatted_price, city, country, cat1, cat2, status, created_at,ad_note) {
    city = (city) ? city : '';
    country = (country) ? country : '';
    return `
    <div>
        <div class="d-flex flex-md-row flex-column p-sm-3 p-0 pb-sm-3 pb-3 productOut mt-3">
            <div 
               class=" ads-checkbox  mr-md-2 mr-0 mx-auto my-3 my-md-auto d-flex ">
                <input type="checkbox"  name="check[]" id="${id}"
                       value="${id}"/>
                <label class="adv-mul m-0" for="${id}">
                </label>
            </div>
            <div class="productAdvs_Image position-relative col-md-2 p-0">
                <img class='img-thumbnail' src='${image}' alt='${name}'>
            </div>
            <div class="productAdvsText_Area d-flex flex-column ml-sm-2 ml-0 p-sm-0 p-2 flex-grow-1 justify-content-between mt-md-0 mt-3 flex-fill">
                <div class="row">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between flex-md-row flex-column">
                            <div class="d-flex flex-column overflow-hidden">
                                <div class="text_2">
                                    <a href='${href ?? ''}' class='text-dark'>
                                        <p>${name ?? ''}</p>
                                    </a>
                                </div>
                                <div class="flex-wrap d-sm-flex d-none">
                                    <div class="mb-2 align-items-center d-flex">
                                        <div class="font-weight-bold color_8 text_3 fs-14">
                                            ${formatted_price}
                                        </div>
                                        <div class="lineGap"></div>
                                    </div>
                                </div>
                                <div class="fs-14 color_9 mb-sm-0 mb-3">${created_at_text} : &nbsp; ${created_at.slice(0, 10).replaceAll('-', '.')}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <div class="mr-1">${ads_no}:</div>
                        <div class="font-weight-bold">${id}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-md-row flex-column p-sm-3 p-0 pb-sm-3 pb-3 bg-white justify-content-between ">
            <div class="text_2  px-2 mt-3 mt-md-0">
                <p class="mb-2 font-weight-bold">${ad_note_text}</p>
                <p>${ad_note ?? ''}</p>
            </div>
            <div class="d-flex justify-content-end align-items-center ">
                      ${dropdownRow(id, status)}
            </div>
        </div>
    </div>
            
    `;
}

function addDropdownBlock() {
    const dropdowns = $('.my-ads-dropdown')
    for (let i = 0; i < dropdowns.length; i++) {
        const currentDropdown = $(dropdowns[i])
        $('> .dropdown-menu', currentDropdown).append(dropdownBlock.replaceAll(':id', currentDropdown.data('id')))
    }
}

function dropdownRow(id, type) {
    var dropdown = "<div class='dropdown my-ads-dropdown' data-id='" + id + "'>\n" +
        "  <button class='dropdown-toggle btn btn-outline-dark border' type='button' id='dropdownMenuButton' data-toggle='dropdown'>\n" +
        choose_text +
        "  </button>\n" +
        "  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>\n";
    if (type == "passive") {
        dropdown += "<a class='dropdown-item text-success' href='/advs/status/" + id + ",approved'>" +
            "<i class='fas fa-eye'></i> " +
            approve +
            "</a>\n";
    } else {
        dropdown += "<a class='dropdown-item text-secondary' href='/advs/status/" + id + ",passive'>" +
            "<i class='fas fa-eye-slash'></i> " +
            passive +
            "</a>\n";
    }

    dropdown += "<a class='dropdown-item text-primary' href='/advs/edit_advs/" + id + "'>" +
        "<i class='fas fa-pencil-alt'></i> " +
        edit_ad +
        "</a>\n";

    dropdown += "<a class='dropdown-item text-danger' href='/advs/delete/" + id + "'>" +
        "<i class='fas fa-trash'></i> " +
        delete_ad +
        "</a>\n";
    dropdown += "<span class='dropdown-item text-dark' onClick='printAdProfile(" + id + ");return false;'>" +
        "<i class='fa fa-print'></i> " +
        print +
        "</span>\n";

    if (Object.keys(userStatus).length) {
        let statusItems = ''
        for (const status in userStatus) {
            statusItems += `
            <li>
                <a class="dropdown-item"
                    href="${statusChangeLink.replace(':adID', id).replace(':statusID', status)}">
                    ${userStatus[status]}
                </a>
            </li>
        `
        }

        dropdown += `
        <li class="dropdown-submenu dropleft">
            <button type="button" class="btn dropdown-item dropdown-toggle">${changeStatusTrans}</button>
            <ul class="dropdown-menu">
                ${statusItems}
            </ul>
          </li>
        `;
    }

    dropdown += "</div></div>";

    return dropdown;
}

// Nested dropdown
$('.tab-pane').on('click', '.dropdown-menu button.dropdown-toggle', function (e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
    }
    var $subMenu = $(this).next('.dropdown-menu');
    $subMenu.toggleClass('show');

    $(this).parents('.my-ads-dropdown.show').on('hidden.bs.dropdown', function (e) {
        $('.dropdown-submenu .show').removeClass('show');
    });

    return false;
});


$(() => {
    if (session_message){
        Swal.fire({
            icon: session_status,
            text: session_message,
            showConfirmButton: false,
            timer: 3500
        })
    }
    $('.all-box').on('click', () =>  {
        const allCheckbox = $('#all');
        const isChecked = allCheckbox.prop('checked');
        $('input[name="check[]"]').prop('checked', !isChecked);
    })
})

