var level = 0;
var selected;
var all_categories = {};
var promiseForCategory = new Promise(function (resolve) {
    if (categories.length != 0) {
        $.each(categories, function (index, value) {
            crudAjax({'level': level, "cat": categories['cat' + level]}, '/class/ajaxCategory', 'POST', function (callback) {
                // console.log('cat' + (level + 1), categories['cat' + level], callback)
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

    categories_list = $.grep(Object.values(categories_list), function (e) {
        return (e.length > 0) ? e : '';
    });

    level = 0;
    $.each(categories_list, function (index, value) {
        level++;
        index = `cat${index + 1}`;
        $('.category-row').append(CategoryField(index, level));
        searchCategoryName(index)
        $.each(value, function (index2, value2) {
            selected = "";
            if (id_list[index] == value2.id) {
                selected = "selected";
            }
            $('.' + index).append("<option value='" + value2.id + "'" + selected + ">" + value2.name + "</option>");
        });
    });
    $('.category-row').append(completedField());
})

function CategoryField(name, level) {
    return '<div class="col-12 col-md-3 category-box p-2" data-level="' + level + '">\n' +
        '                    <div class="col-12 border p-0">\n' +
        '<div class="col-12 p-0">\n' +
        '    <input type="text" id="searchCategory-' + name + '" class="form-control"\n' +
        '           placeholder="' + search + '">\n' +
        '</div>' +
        '                        <select name="' + name + '" class="cat-select w-100 ' + name + '" data-level="'
        + level + '" multiple>\n' +
        '                        </select>\n' +
        '                    </div>\n' +
        '                </div>';
}

function completedField() {
    return '<div class="col-12 col-md-3 category-box py-5 px-2">\n' +
        '                    <div class="col-12 p-0 text-center">\n' +
        '                        <h5>\n' +
        continue_message +
        '                        </h5>\n' +
        '                        <button type="submit" name="action" value="update" class="btn btn-primary btn-lg w-100">\n' +
        continue_btn +
        '                        </button>\n' +
        '                    </div>\n' +
        '                </div>';
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
        var all_category_box = $('.category-row').find('.category-box');
        var level = parseInt($(this).attr('data-level')) + 1;

        //Remove right select fields
        for (var i = level - 1; i <= all_category_box.length - 1; i++) {
            all_category_box[i].remove();
        }

        scroolToSelect(all_category_box)

        crudAjax({"cat": value[0], 'level': level}, '/class/ajaxCategory', 'POST', function (callback) {
            if (callback.length <= 0) {
                $('.category-row').append(completedField());
            } else {
                $('.category-row').append(CategoryField('cat' + level, level));
                $.each(callback, function (index, value) {
                    $('.cat' + level).append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            }
            selectedValue().unbind()
            searchCategoryName('cat' + level)
            return selectedValue();
        })
    })
}

function searchCategoryName(name) {
    var searchField = $("#searchCategory-" + name);
    searchField.unbind();
    searchField.on("keyup", function () {
        var value = this.value.toLowerCase().trim();
        $('.' + name + ' option').show().filter(function () {
            return $(this).text().toLowerCase().trim().indexOf(value) == -1;
        }).hide();
    });
}

function scroolToSelect(fields) {
    //Scrool Screen
    $([document.documentElement, document.body]).animate({
        scrollTop: $(fields[fields.length - 1]).offset().top + 300
    }, 1000);
}