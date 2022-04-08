(function ($) {
    $.Redactor.prototype.imagemanager = function () {
        return {
            init: function () {

                let button = this.button.add('image', 'Insert Image');

                this.button.setIcon(button, '<i class="fa fa-picture-o"></i>');

                this.button.addDropdown(
                    button, {
                        select: {
                            title: 'Select Image',
                            func: this.imagemanager.select
                        },
                        upload: {
                            title: 'Upload Image',
                            func: this.imagemanager.upload
                        }
                    }
                );

                $('#' + this.opts.element.attr('name') + '-modal').on(
                    'click',
                    '[data-select="image"]',
                    this.imagemanager.insert
                );
            },
            select: function () {

                this.selection.save();

                let params = this.imagemanager.params();

                $('#' + this.opts.element.attr('name') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load(REQUEST_ROOT_PATH + '/streams/wysiwyg-field_type/index?' + params);
            },
            upload: function () {

                this.selection.save();

                let params = this.imagemanager.params();

                $('#' + this.opts.element.attr('name') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load(REQUEST_ROOT_PATH + '/streams/wysiwyg-field_type/choose?' + params);
            },
            insert: function (e) {

                this.selection.restore();

                this.buffer.set();
                this.air.collapsed();

                let file = $(e.target).data('entry');

                if (file == undefined) {

                    console.log(e);

                    alert('There was a problem attaching this image. Please try again.');

                    return false;
                }

                let url = file.indexOf('http') == 0 ? file : REQUEST_ROOT_PATH + '/files/' + file;

                let alt = url.substring(url.lastIndexOf('/') + 1);

                alt = alt.substring(0, alt.lastIndexOf('.'));
                alt = alt.toLowerCase().replace(/[_-]+/g, ' ').replace(/\s{2,}/g, ' ').trim();
                alt = alt.charAt(0).toUpperCase() + alt.slice(1);

                this.insert.node($('<img alt="' + alt + '" />').attr('src', url));

                $(e.target).closest('.modal').modal('hide');

                return false;
            },
            params: function () {
                return $.param({
                    mode: 'image',
                    folders: this.opts.folders
                });
            }
        };
    };
})(jQuery);
