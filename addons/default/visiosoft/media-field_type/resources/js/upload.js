// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;
$("div#myDrop").dropzone({url: "/file/post"});

var doc_input = $('input[name="doc_files"]');


var uploaded = $('input[name="files"]').val().split(',').map(Number);

if (doc_input.length) {
    var docsUploaded = doc_input.val().split(',').map(Number);
}

$(function () {

    var uploader = $('#upload');
    var element = $('.dropzone');
    var template = uploader.find('.template');
    var preview = template.html();

    template.remove();

    var dropzone = new Dropzone('.dropzone:not(data-initialized)',
        {
            paramName: 'upload',
            maxFiles: imageCount,
            resizeWidth: settings_image['resize_width'],
            resizeHeight: settings_image['resize_height'],
            autoProcessQueue: true,
            parallelUploads: 1,
            resizeMethod: 'contain',
            resizeQuality: 0.9,
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
                return new Date().getTime() + '_' + file.name.replace(/ /g, '_');
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
        var mimeType = response.mime_type.split('/')
        if (mimeType[0] === 'image') {
            uploaded.push(response.id);

            $('.media-selected-wrapper').load(
                REQUEST_ROOT_PATH + '/streams/media-field_type/selected?uploaded=' + uploaded.join(','),
                function () {
                    $('input[name="files"]').val(uploaded.join(','))
                }
            );

            file.previewElement.querySelector('[data-dz-uploadprogress]').setAttribute('class', 'progress progress-success');

            setTimeout(function () {

                addAppendByData(uploaded[0])
                file.previewElement.remove();
            }, 500);
        } else {
            if (doc_input.length) {
                docsUploaded.push(response.id);
                $('input[name="doc_files"]').val(docsUploaded.join(','))

                $('.doc_list').append(`
                <a id="${response.id}" href="javascript:void(0)" onclick="deleteDocs(${response.id})" class="text-dark">
                                ${response.name}
                    <i class="fa fa-trash text-danger"></i>
                </a><br>
            `)

                setTimeout(function () {

                    addAppendByData(docsUploaded[0])
                    file.previewElement.remove();
                }, 500);
            }
        }
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


function deleteImage(e, id) {
    e.preventDefault()

    var key_item = $.inArray(id, uploaded);
    uploaded.splice(key_item, 1);
    $('input[name="files"]').val(uploaded.join(','))
    $('.imageList').find('div[data-id="' + id + '"]').remove()
}

function deleteDocs(id) {
    var key_item = $.inArray(id, docsUploaded);
    docsUploaded.splice(key_item, 1);
    $('input[name="doc_files"]').val(docsUploaded.join(','))
    $('.doc_list').find('#' + id).remove()
}

function rotateImage(e, id) {
    e.preventDefault()

    var img = $('.ads-box-image[data-id="' + id + '"]').find('img')
    var img_url = img.attr('src');
    $.ajax({
        type: 'get',
        dataType: "json",
        data: {img_url: img_url},
        url: '/image/rotate',
        success: function (response) {
            if (response.status == "success") {
                var newURL = updateQueryStringParameter(img_url, 't', Math.floor(Math.random() * 100000000));
                img.attr('src', newURL);
            }
        }
    });
}


//Set Main Image
function setMain(e, id) {
    e.preventDefault()

    $('.main-image').remove();
    var key_item = $.inArray(id, uploaded);
    uploaded.splice(key_item, 1);
    uploaded.unshift(id);
    $('input[name="files"]').val(uploaded.join(','))

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
