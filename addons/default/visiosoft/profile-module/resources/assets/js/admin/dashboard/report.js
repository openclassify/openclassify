$(document).ready( function () {
    $('#newMemberReport').DataTable({
        ajax: {
            url: '/admin/api/profile/report/latest',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: 'member', defaultContent: usersReportTrans.undefined_member },
            { data: 'date' },
        ],
    });

    $('#loginMemberReport').DataTable({
        ajax: {
            url: '/admin/api/profile/report/login',
            dataSrc( json ) {
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;

                return json.data;
            }
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: 'member', defaultContent: usersReportTrans.undefined_member },
            { data: 'date' },
        ],
    });
} );
