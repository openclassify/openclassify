$(document).ready(function () {
    var selected;
    var selectedCatId = $('select[name=filter_category] option').filter(':selected').val();

    if (selectedCatId != "" && selectedCatId != undefined) {
        $.ajax({
            type: 'POST',
            url: 'get-sub-cats/' + selectedCatId,
            data: 'id=' + selectedCatId,
            success: function (data) {
                if (data != "") {
                    $('select[name=filter_sub_category]').html('');
                    $('select[name=filter_sub_category]').append(data);
                } else {
                    $('select[name=filter_sub_category]').html('<option selected="">' + trans_sub_category + '</option>');
                }
            }
        });
    }

    if (typeof search_category_url !== "undefined") {
        $("select[name='parent_category[]']").select2({
            ajax: {
                url: search_category_url,
                type: "GET",
                data: function (params) {
                    if ($(this).val() != null)
                        selected = $(this).val().join("-")
                    return {
                        q: params.term, // search term
                        selected: selected
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.category, function (item) {
                            return {
                                text: item.parents,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
            allowClear: true,
            theme: "classic",
            placeholder: "All",
            minimumInputLength: 3
        });
    }

    if (window.location.pathname != "/admin/customfields/create" && typeof selected_category !== "undefined") {
        jsonArray = JSON.parse(selected_category.replace(/&quot;/g, '"'));
        $('#parentCat').html(convertObjectToSelectOptions(jsonArray)).trigger('change');
    }

    groupOptions()
});

function groupOptions() {
    if (typeof chooseAnOptionTrans !== "undefined") {
    $('#type').html(`
        <select name="type" class="custom-select form-control" data-field="type" data-field_name="type"
            data-provides="anomaly.field_type.select" id="type">
            <option value="">${chooseAnOptionTrans}</option>
            <optgroup label="${textInputTrans}">
               <option value="text">${$('[value=text]').text()}</option>
            </optgroup>
            <optgroup label="${choosingOptionsTrans}">
                <option value="select">${$('[value=select]').text()}</option>
                <option value="selectdropdown">${$('[value=selectdropdown]').text()}</option>
                <option value="selecttop">${$('[value=selecttop]').text()}</option>
                <option value="checkboxes">${$('[value=checkboxes]').text()}</option>
                <option value="radio">${$('[value=radio]').text()}</option>
                </optgroup>
            <optgroup label="${valuesTrans}">
                <option value="decimal">${$('[value=decimal]').text()}</option>
                <option value="integer">${$('[value=integer]').text()}</option>
            </optgroup>
            <optgroup label="${otherTrans}">
                <option value="range">${$('[value=range]').text()}</option>
                <option value="selectrange">${$('[value=selectrange]').text()}</option>
                <option value="selectimage">${$('[value=selectimage]').text()}</option>
                <option value="date-text">${$('[value=datetime]').text()}</option>
            </optgroup>
        </select>
    `)
    }
}

function convertObjectToSelectOptions(values) {
    var htmlTags = '';
    $.each(values, function (index, obj) {
        for (var tag in obj) {
            htmlTags += '<option value="' + tag + '" selected="selected">' + obj[tag] + '</option>';
        }
    });

    return htmlTags;
}

$(document.body).on('click', 'select[name=filter_category]', function () {
    var selectedCatId = $('select[name=filter_category] option').filter(':selected').val();

    if (selectedCatId != "") {
        $.ajax({
            type: 'POST',
            url: 'get-sub-cats/' + selectedCatId,
            data: 'id=' + selectedCatId,
            success: function (data) {
                if (data != "") {
                    $('select[name=filter_sub_category]').html('');
                    $('select[name=filter_sub_category]').append(data);
                } else {
                    $('select[name=filter_sub_category]').html('<option selected="">' + trans_sub_category + '</option>');
                }
            }
        });
    }

});