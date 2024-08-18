$('#filter_modal_btn').on('click', function () {
    $('#filterModal').modal('toggle');
})

$('.edit-category-filter-modal').on('click', function () {
    $('#filterModal').modal('hide');
    $('#categoryModal').modal('toggle');
})

var level = 0;
var id_list = categories;
var selected;
var selected_cat;
var all_categories = {};
var promiseForCategory = new Promise(function (resolve) {
    if (categories.length != 0) {
        $.each(categories, function (index, value) {
            crudAjax({
                'level': level,
                "cat": categories['cat' + level]
            }, '/class/ajaxCategory', 'POST', function (callback) {
                all_categories['cat' + (level + 1)] = callback;
            })
            level++;
        });
    } else {
        crudAjax({'level': level, "cat": ""}, '/class/ajaxCategory', 'POST', function (callback) {
            all_categories['cat' + (level + 1)] = callback;
        })
        level++;
    }
    resolve(all_categories);
});

promiseForCategory.then(function (categories_list) {
    level = 0;
    $.each(categories_list, function (index, value) {
        level++;
        $('.category-row').append(CategoryField(index, level));
        $.each(value, function (index2, value2) {
            selected = "";
            if (id_list[index] == value2.id) {
                selected = "selected";
                selected_cat = value2.id;
            }
            $('.' + index).append("<option value='" + value2.id + "'" + selected + ">" + value2.name + "</option>");
        });
    });
    level++;
    crudAjax({
        'level': level,
        "cat": id_list['cat' + Object.keys(id_list).length]
    }, '/class/ajaxCategory', 'POST', function (callback) {

        if(callback.length > 0)
        {
            $('.category-row').append(CategoryField('cat'+level, level));
            $.each(callback, function (index2, value2) {
                selected = "";

                $('.' + 'cat'+level).append("<option value='" + value2.id + "'" + selected + ">" + value2.name + "</option>");
            });
        }

    })

})


function CategoryField(name, level) {
    return '<div class="col-12 px-0 py-1 category-select-mobile category-box" data-level="' + level + '">\n' +
        '</span>\n<select data-level="' + level + '" class="form-control cat-select ' + name + '">\n' +
        '<option>'+ catsPlaceholder +'</option>' +
        '</select>\n</div>';
}


$(document).ready(function () {

    $(".cat-select").on('change', function (e) {
        if (Object.keys($(this).val()).length > 1) {
            $('option[value="' + $(this).val().toString().split(',')[1] + '"]').prop('selected', false);
        }
    });
    selectedValue()
});


function selectedValue() {
    return $('.cat-select').on('change', function () {
        var value = $(this).val();
        $('.set_category').attr("data-selected", value);
        $('input[name="cat"]').val(value)
        var all_category_box = $('.category-row').find('.category-box');
        var level = parseInt($(this).attr('data-level')) + 1;

        //Remove right select fields
        for (var i = level - 1; i <= all_category_box.length - 1; i++) {
            all_category_box[i].remove();
        }


        crudAjax({"cat": value, 'level': level}, '/class/ajaxCategory', 'POST', function (callback) {
            if (callback.length > 0) {
                $('.category-row').append(CategoryField('cat' + level, level));
                $.each(callback, function (index, value) {
                    $('.cat' + level).append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            }
            selectedValue().unbind()
            editCategorySpan()
            return selectedValue();
        })
    })
}


function editCategorySpan() {
    $('.selected-category-name').html("")
    $.each($('.category-row').find('.category-select-mobile'), function (index, value) {
        var selected_name = $(this).find('.cat-select').find(':selected');
        $('.selected-category-name').append(selected_name.html() + ',');
    });
}

$('.set_category').on('click', function () {

    $('#categoryModal').modal('hide');

    $('#filterModal').find('form').attr("action", '/advs/list');
    $('#filterModal').modal('toggle');
});