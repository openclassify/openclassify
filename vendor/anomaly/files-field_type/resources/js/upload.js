// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;

$(function () {

    let uploaded = [];

    let uploader = $('#upload');
    let element = $('.dropzone');
    let template = uploader.find('.template');
    let preview = template.html();
    let duplicates = uploader.find('select[name="duplicates"]');

    template.remove();

    let dropzone = new Dropzone('.dropzone:not(data-initialized)',
        {
            paramName: 'upload',
            url: REQUEST_ROOT_PATH + '/streams/files-field_type/handle',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            init: function () {
                $('.dropzone').attr('data-initialized', '');
            },
            sending: function (file, xhr, formData) {
                formData.append('folder', element.data('folder'));
            },
            accept: function (file, done) {

                if (duplicates.val() == 'ignore') {

                    dropzone.removeFile(file);

                    return;
                }

                if (duplicates.val() == 'overwrite') {

                    done();

                    return;
                }

                $.post(REQUEST_ROOT_PATH + '/streams/files-field_type/exists/' + element.data('folder'), { 'file': file.name }, function (data) {

                    if (data.exists) {
                        if (!confirm(file.name + " " + element.data('overwrite'))) {
                            dropzone.removeFile(file);
                            return;
                        }
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

        let response = JSON.parse(file.xhr.response);

        uploaded.push(response.id);

        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-success');

        setTimeout(function () {
            file.previewElement.remove();
        }, 500);
    });

    // When file fails to upload.
    dropzone.on('error', function (file, response) {

        file.previewElement.querySelector("[data-dz-uploadprogress]").setAttribute('value', 100);
        file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-danger');

        alert(response.message);
    });

    // When all files are processed.
    dropzone.on('queuecomplete', function () {

        uploader.find('.uploaded .modal-body').html(element.data('loading') + '...');

        uploader.find('.uploaded').load(REQUEST_ROOT_PATH + '/streams/files-field_type/recent?uploaded=' + uploaded.join(','));
    });
});
