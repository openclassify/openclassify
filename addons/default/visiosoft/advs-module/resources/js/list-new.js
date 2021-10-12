// Init tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// Handle table header sorting
$('.sortable').on('click', function () {
    const searchParams = new URLSearchParams(window.location.search);
    const sortBy = searchParams.get('sort_by');
    const direction = $(this).hasClass('sort-desc') ? 'asc' : 'desc';
    const value = $(this).data(`sort-${direction}`);

    let url = window.location.href;
    if (url.slice(-1) === "#") {
        url = url.slice(0, -1);
    }

    let goURL;
    if (window.location.search == "") {
        goURL = `${url}?sort_by=${value}`;
    } else if (searchParams.has('sort_by')) {
        const parameters = value !== 'all' ? "sort_by=" + value : "";
        goURL = location.href.replace(`sort_by=${sortBy}`, parameters);
    } else {
        goURL = `${url}&sort_by=${value}`;
    }

    window.location.replace(goURL);
})
