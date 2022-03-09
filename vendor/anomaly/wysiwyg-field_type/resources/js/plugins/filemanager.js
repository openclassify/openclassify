(function($) {
    $.Redactor.prototype.filemanager = function() {
        return {
            init: function() {

                let button = this.button.add('file', 'Insert File');

                this.button.setIcon(button, '<i class="fa fa-paperclip"></i>');

                this.button.addDropdown(
                    button, {
                        select: {
                            title: 'Select File',
                            func: this.filemanager.select
                        },
                        upload: {
                            title: 'Upload File',
                            func: this.filemanager.upload
                        }
                    }
                );

                $('#' + this.opts.element.attr('name') + '-modal').on(
                    'click',
                    '[data-select="file"]',
                    this.filemanager.insert
                );
            },
            select: function() {

                this.selection.save();

                let params = this.filemanager.params();

                $('#' + this.opts.element.attr('name') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load(REQUEST_ROOT_PATH + '/streams/wysiwyg-field_type/index?' + params);
            },
            upload: function() {

                this.selection.save();

                let params = this.filemanager.params();

                $('#' + this.opts.element.attr('name') + '-modal')
                    .modal('show')
                    .find('.modal-content')
                    .load(REQUEST_ROOT_PATH + '/streams/wysiwyg-field_type/choose?' + params);
            },
            insert: function(e) {

                this.selection.restore();

                this.buffer.set();
                this.air.collapsed();

                let file = $(e.target).data('entry');

                if (file == undefined) {

                    console.log(e);

                    alert('There was a problem attaching this file. Please try again.');

                    return false;
                }

                let url = file.indexOf('http') == 0 ? file : REQUEST_ROOT_PATH + '/files/download/' + file;

                this.insert.node($('<a />').attr('href', url).text(this.selection.is() ? this.selection.text() : url));

                $(e.target).closest('.modal').modal('hide');

                return false;

            },
            params: function() {
                return $.param({
                    mode: 'file',
                    folders: this.opts.folders
                });
            }
        };
    };
})(jQuery);
