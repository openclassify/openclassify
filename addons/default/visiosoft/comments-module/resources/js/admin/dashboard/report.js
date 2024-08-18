$(document).ready( function () {
    $('#topProductReport').DataTable({
        ajax: {
            url: '/admin/api/comments/report/product',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "desc" ]],
        columns: [
            { data: 'name', defaultContent: topProductReportTrans.unspecified_product },
            { data: 'rate' },
        ],
    });

    $('#mostCommentReport').DataTable({
        ajax: {
            url: '/admin/api/comments/report/comment',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        order: [[ 1, "desc" ]],
        columns: [
            { data: 'name', defaultContent: topProductReportTrans.unspecified_product },
            { data: 'count' },
        ],
    });
} );
