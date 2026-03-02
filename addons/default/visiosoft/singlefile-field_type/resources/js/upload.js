// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;

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
            url: REQUEST_ROOT_PATH + '/streams/singlefile-field_type/handle',
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
                return new Date().getTime() + '_' + file.name.replace(/ /g, '_');
            },
            accept: function (file, done) {
                $.get(REQUEST_ROOT_PATH + '/streams/singlefile-field_type/exists/' + element.data('folder'), {'file': file.name}, function (data) {
                    if (data.exists) {
                        // renamed
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

    // When all files are processed.
    dropzone.on('queuecomplete', function () {

        uploader.find('.uploaded .modal-body').html(element.data('loading') + '...');

        $.when(
            $.get(REQUEST_ROOT_PATH + '/streams/singlefile-field_type/recent?uploaded=' + uploaded.join(','), function(data) {
                uploader.find('.uploaded').html(data);
            })
        ).done(function() {
            let changedPhoto = new CustomEvent('uploadedSingleField');

            window.dispatchEvent(changedPhoto);
        });
    });
});
