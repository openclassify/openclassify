$(document).ready( function () {
    $('#stockReport').DataTable({
        ajax: {
            url: '/admin/api/classified/report/stock',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
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
        ajax: {
            url: '/admin/api/classified/report/unexplained',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id', orderable: false },
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
        ajax: {
            url: '/admin/api/classified/report/no-image',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
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

    $('#metaPageReport').DataTable({
        ajax: {
            url: '/admin/api/classified/report/page',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        columns: [
            {
                data: 'name',
                render: function ( data, type, row, meta ) {
                    return `
                        <a href="/admin/pages/edit/${row.id}" class="text-info">
                            ${data ?? productsReportTrans.undefined_page}
                        </a>
                    `;
                }
            },
        ],
    });
} );
