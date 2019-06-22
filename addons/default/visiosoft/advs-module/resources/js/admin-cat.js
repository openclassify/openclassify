$(document).ready(function () {
    const query = {};
    query.getParentCats = (id) => {
        $.ajax({
            type: 'get',
            url: '/categories/checkparent/' + id,
            success: function (response) {
                hideLoader()
                var array = response.reverse();
                for(var i=0;i<array.length;i++){
                    if (i != 0) {
                        array[i]=" > " + array[i];
                    }
                }
                $('[name="parent_category"] option[value="'+ id + '"]').html(array);
            },
            beforeSend: function () {
                showLoader()
            },
            error:function (err) {
                return 'it broke';
            }
        });
    };

    $('[name="parent_category"] option').each(function (value) {
        if (value != 0) {
            query.getParentCats(value);
        }
    });
});