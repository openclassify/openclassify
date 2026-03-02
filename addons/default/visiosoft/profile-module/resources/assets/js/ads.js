var current_page = 1;
var records_per_page = ads_per_page;
var ads_type = "";

var objJson = [];
let totalAdvs = 0

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
    var listing_table = $("#nav-" + ads_type);
    var page_span = $("#page");

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    listing_table.html("");

    if (objJson.length === 0) {
        listing_table.html(`
            <div class="alert alert-warning" role="alert">
                ${no_ads_message}
            </div>
        `);
    }
    for (var i = 0; i < objJson.length; i++) {
        listing_table.append(addAdsRow(objJson[i].id, objJson[i].detail_url, objJson[i].cover_photo, objJson[i].name,
            objJson[i].formatted_price, objJson[i].city_name, objJson[i].country_name, objJson[i].cat1_name,
            objJson[i].cat2_name, objJson[i].status));
    }

    addDropdownBlock()

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

function getMyAdvs(type) {
    crudAjax({'type': type, 'paginate': true, 'page': current_page}, '/ajax/getAdvs', 'GET', function (callback) {
        ads_type = type;
        objJson = callback.content.data;
        totalAdvs = callback.content.total
        changePage(current_page);
    })
}

$('.profile-advs-tab a').on('click', function () {
    current_page = 1
    getMyAdvs($(this).attr('data-type'))
});

const urlString = window.location.href;
const url = new URL(urlString);
let type = url.searchParams.get("type");
type = type ? type : 'approved';
getMyAdvs(type);


function addAdsRow(id, href, image, name, formatted_price, city, country, cat1, cat2, status) {
    city =  (city) ? city : '';
    country =  (country) ? country : '';
    return `
        <div class='col-md-12 mb-2 profile-ads border-bottom border-white'>
            <div class='row bg-light'>
                <div class='col-md-2 justify-content-center align-self-center border-right border-white'>
                    <img class='img-thumbnail' src='${image}' alt='${name}'>
                </div>
                <div class='col-md-7 justify-content-center align-self-center border-right border-white'>
                    <div class='row'>
                        <div class='col-md-10'>
                            <a href='${href}' class='text-dark'>
                                <p>${name}</p>
                            </a>
                        </div>
                        <div class='col-md-2 text-right'>
                            ${dropdownRow(id, status)}
                        </div>
                        <div class='col-md-12 text-truncate'>
                            <small class='text-muted'>${cat1}, ${cat2}</small>
                        </div>
                    </div>
                </div>
                <div class='col-md-3 text-left justify-content-center align-self-center'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <b>${formatted_price}</b>
                        </div>
                        <div class='col-md-12 justify-content-center align-self-center text-truncate'>
                            <small>${city} ${country}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function dropdownRow(id, type) {
    var dropdown = "<div class='dropdown my-ads-dropdown' data-id='" + id + "'>\n" +
        "  <button class='dropdown-toggle btn btn-outline-dark' type='button' id='dropdownMenuButton' data-toggle='dropdown'>\n" +
        "<i class=\"fas fa-ellipsis-v\"></i>" +
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

function addDropdownBlock() {
    const dropdowns = $('.my-ads-dropdown')
    for (let i = 0; i < dropdowns.length; i++) {
        const currentDropdown = $(dropdowns[i])
        $('> .dropdown-menu', currentDropdown).append(dropdownBlock.replaceAll(':id', currentDropdown.data('id')))
    }
}

// Nested dropdown
$('.tab-pane').on('click', '.dropdown-menu button.dropdown-toggle', function(e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
    }
    var $subMenu = $(this).next('.dropdown-menu');
    $subMenu.toggleClass('show');

    $(this).parents('.my-ads-dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass('show');
    });

    return false;
});
