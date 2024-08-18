$(document).ready(function () {
    if(typeof tag_fields !== "undefined")
    {
        $.each(tag_fields, function (a, tag) {
            tag.DOM.input.addEventListener('keyup', function (event) {
                var is_zero = tag.getTagIndexByValue('0');
                if (is_zero.length > 0) {
                    tag.removeTag(tag.getTagElmByValue('0'))
                    tag.addTags([{value: "zero"}]);
                }
            });
        })
    }
});


