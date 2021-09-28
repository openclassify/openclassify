$(document).ready( function () {
    $('#stockReport').DataTable({
        ajax: '/admin/api/classified/report/stock',
        order: [[ 1, "asc" ]],
        columns: [
            {
                data: 'name',
                render: function ( data, type, row, meta ) {
                    return `
                        <a href="/admin/advs/edit/${row.id}" class="text-info">
                            ${data ?? productsReportTrans.undefined_product}
                        </a>
                    `;
                }
            },
            { data: 'stock' },
        ],
    });

    $('#activePassiveReport').DataTable({
        ajax: '/admin/api/classified/report/status',
        columns: [
            { data: 'status' },
            { data: 'count' },
        ],
    });

    $('#unexplainedReport').DataTable({
        ajax: '/admin/api/classified/report/unexplained',
        columns: [
            {
                data: 'name',
                render: function ( data, type, row, meta ) {
                    return `
                        <a href="/admin/advs/edit/${row.id}" class="text-info">
                            ${data ?? productsReportTrans.undefined_product}
                        </a>
                    `;
                }
            },
        ],
    });

    $('#noImageReport').DataTable({
        ajax: '/admin/api/classified/report/no-image',
        columns: [
            {
                data: 'name',
                render: function ( data, type, row, meta ) {
                    return `
                        <a href="/admin/advs/edit/${row.id}" class="text-info">
                            ${data ?? productsReportTrans.undefined_product}
                        </a>
                    `;
                }
            },
        ],
    });
} );
