const Toast = {
    fire: function (message, type) {

        $('body').addClass('swal2-shown swal2-toast-shown');

        if ($('body').find('.swal2-container').length < 1) {
            $('body').append('<div class="swal2-container swal2-top-end swal2-backdrop-show" style="overflow-y: auto;"></div>');
        }

        let alert_icon = `<div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
        <div class="swal2-success-ring"></div><div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div></div>`;

        switch (type) {
            case "error":
                alert_icon = `<div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark">
                <span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>`;
                break;
            case "info":
                alert_icon = `<div class="swal2-icon swal2-info swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">i</div></div>`;
            case "warning":
                alert_icon = `<div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>`;
                break;
        }


        $.notify({
            message: message,
        }, {
            element: '.swal2-container',
            position: null,
            allow_dismiss: false,
            newest_on_top: true,
            showProgressbar: true,
            delay: 3000,
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            },
            onClosed: function () {
                $('body').removeClass('swal2-shown swal2-toast-shown');
                $('body .swal2-container').remove();
            },
            icon_type: 'class',
            template: `<div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
                         class="swal2-popup swal2-toast swal2-icon-success " tabindex="-1" role="alert" aria-live="polite"
                         style=" display: grid; width: 100%;">${alert_icon}
                        <h2 class="swal2-title" id="swal2-title" style="display: block;"><span data-notify="message">{2}</span></h2>
                        <div class="swal2-timer-progress-bar-container" data-notify="progressbar">
                        <div class="progress-bar-{0} swal2-timer-progress-bar" role="progressbar" aria-valuenow="0" 
                            aria-valuemin="0" aria-valuemax="100" style="width: 0%; transition: width 1s linear 0s;"></div>
                        </div></div>`
        });
    }
}