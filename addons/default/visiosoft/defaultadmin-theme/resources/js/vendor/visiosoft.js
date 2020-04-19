$( document ).ready(function() {
    if ($("select[name='parent_category']").length ) {
        $("select[name='parent_category']").select2({
            ajax: {
                url: window.location.origin + "/keySearch",
                type: "GET",
                data: function (params) {
                    return {
                        q: params.term // search term
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
            placeholder:"All" ,
            minimumInputLength: 3
        });

        $("select[name='parent_category']").on('select2:select', function (e) {
            var data = e.params.data;
            $("input[name='category_name']").val(data.text);
        });
    }

});
