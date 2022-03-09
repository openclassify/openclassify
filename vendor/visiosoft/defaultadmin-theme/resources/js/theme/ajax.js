$(function () {

    // Detect ajax errors.
    $(document).ajaxError(function (event, xhr) {

        var errors = {
            '401': 'Unauthorized (401)',
            '403': 'Not Allowed (403)',
            '404': 'Page Not Found (404)',
            '500': 'Error (500) - Please check your application error logs.',
        };

        if (Object.keys(errors).includes(String(xhr.status))) {

            // Close all modals.
            $('.modal').modal('hide');

            swal("Oops", errors[xhr.status], "warning");

            if (xhr.status === 401) {
                // If we're in the admin redirect to admin login.
                if (window.location.pathname.startsWith('/admin')) {
                    window.location = APPLICATION_URL + '/admin/login';
                } else {
                    window.location = APPLICATION_URL + '/login';
                }
            }
        }
    });
});
