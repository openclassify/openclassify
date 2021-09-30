$(document).ready( function () {
    $('#metaCategoryReport').DataTable({
        ajax: {
            url: '/admin/api/cats/report/category',
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
                        <a href="/admin/cats/edit/${row.id}" class="text-info">
                            ${data ? data : categoryReportTrans.undefined_category}
                        </a>
                    `;
                }
            },
        ],
    });
} );
