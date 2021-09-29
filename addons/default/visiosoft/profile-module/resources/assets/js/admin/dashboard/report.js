$(document).ready( function () {
    $('#newMemberReport').DataTable({
        ajax: '/admin/api/profile/report/latest',
        order: [[ 1, "desc" ]],
        columns: [
            { data: 'member', defaultContent: usersReportTrans.undefined_member },
            { data: 'date' },
        ],
    });

    $('#loginMemberReport').DataTable({
        ajax: '/admin/api/profile/report/login',
        order: [[ 1, "desc" ]],
        columns: [
            { data: 'member', defaultContent: usersReportTrans.undefined_member },
            { data: 'date' },
        ],
    });
} );
