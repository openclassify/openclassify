$(() => {
    $.ajax({
        url: '/api/getEducation',
        success: ((res)=>{
            $.each(res['education-part'], function (key, value) {
                var selected = ""
                if (res.user.education_part == value.id){ selected = 'selected'; }
                $('#education_part').append('<option '+ selected +' value="'+ value.id +'">' + value.name + '</option>')
            })
        })
    })

    $('#education').on('change', () => {
        $.ajax({
            url: '/api/changeEducation',
            data: {
                info: 'education',
                education: $('#education').val()
            },beforeSend: function (){
                $('#education_part').html('');
            },success: function (response) {
                $('#education_part').html('<option value="">'+ choose_an_option +'</option>')
                $.each(response.data, function (key, value) {
                    $('#education_part').append(
                        '<option value="'+ value.id +'">'+ value.name +'</option>'
                    )
                })
            }
        });
    })
})