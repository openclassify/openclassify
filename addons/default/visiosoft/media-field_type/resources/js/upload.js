// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;
$("div#myDrop").dropzone({url: "/file/post"});


$(function () {
    var uploaded = [];

    var uploader = $('#upload');
    var element = $('.dropzone');
    var template = uploader.find('.template');
    var preview = template.html();

    template.remove();

    var dropzone = new Dropzone('.dropzone:not(data-initialized)',
        {
            paramName: 'upload',
            resizeWidth: 1920,
            resizeHeight: 1920,
            resizeMethod: 'contain',
            resizeQuality: 0.8,
            url: REQUEST_ROOT_PATH + '/streams/media-field_type/handle',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            init: function () {
                $('.dropzone').attr('data-initialized', '');
            },
            sending: function (file, xhr, formData) {
                formData.append('folder', element.data('folder'));
            },
            renameFile: function (file) {
                let newName = new Date().getTime() + '_' + adv_id + "_" + file.name;
                return newName;
            },
            accept: function (file, done) {
                $.get(REQUEST_ROOT_PATH + '/streams/media-field_type/exists/' + element.data('folder'), {'file': file.name}, function (data) {
                    if (data.exists) {
                        //renamed
                    }
                    done();
                }, 'json');
            },
            autoQueue: true,
            thumbnailWidth: 24,
            thumbnailHeight: 24,
            previewTemplate: preview,
            previewsContainer: '.uploads',
            maxFilesize: element.data('max-size'),
            acceptedFiles: element.data('allowed'),
            parallelUploads: element.data('max-parallel'),
            dictDefaultMessage: element.data('icon') + ' ' + element.data('message'),
            uploadprogress: function (file, progress) {
                file.previewElement.querySelector("[data-dz-uploadprogress]").setAttribute('value', progress);
            }
        }
    );

    // While file is in transit.
    dropzone.on('sending', function () {
        uploader.find('.uploaded .card-block').html(element.data('uploading') + '...');
    });

    // When file successfully uploads.
    dropzone.on('success', function (file) {

        var response = JSON.parse(file.xhr.response);

        uploaded.push(response.id);
        $('.panel-table').load(
            REQUEST_ROOT_PATH + '/streams/media-field_type/selected?uploaded=' + uploaded.join(','),
            function () {
                $('input[name="files"]').val(uploaded.join(','))
            }
        );

        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-success');

        setTimeout(function () {
            file.previewElement.remove();
        }, 500);
    });

    // When file fails to upload.
    dropzone.on('error', function (file, message) {
        file.previewElement.querySelector("[data-dz-uploadprogress]").setAttribute('value', 100);
        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-danger');
        alert(message.error ? message.error : message);
    });

});

function addAppendByData(data_id) {
    return $('a[data-id=' + data_id + ']').parent().parent().append('<div class="main-image image-eye-' + data_id + '"><i class="fa fa-eye "></i></div>');
}

$('.panel-table').on('click', '[data-dismiss="file"]', function (e) {
    var arr = $('input[name="files"]').val().split(',');
    arr.splice(arr.indexOf(String($(this).data('file'))), 1);
    $('.panel-table').load(
        REQUEST_ROOT_PATH + '/streams/media-field_type/selected?uploaded=' + arr.join(','),
        function () {
            $('input[name="files"]').val(arr.join(','))
        }
    );
});


$('a[data-action="rotate-image"]').click(function () {
    var event = $(this).parent('div').parent('div').find('img');
    var img = event.attr('src');
    $.ajax({
        type: 'get',
        dataType: "json",
        data: {img_url: img},
        url: '/image/rotate',
        success: function (response) {
            if (response.status == "success") {
                hideLoader()
                var newURL = updateQueryStringParameter(img, 't', Math.floor(Math.random() * 100000000));
                event.attr('src', newURL);
            }
        },
        beforeSend: function () {
            showLoader()
        }
    });
});


//Set Main İmage
function setMain(id) {
    var imageList = $('[name="files"]').val().split(',');
    $('.image-eye-' + imageList[0]).remove();
    if (imageList.length != 1) {
        imageList.splice($.inArray(id, imageList), 1);
        $('[name="files"]').val(id + ',' + imageList.join(','));
    }
    addAppendByData(id);
}

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        return uri + separator + key + "=" + value;
    }
}