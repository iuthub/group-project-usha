$('#first_trigger').trigger('click');
$('#second_modal_submit').click(function () {
    let role = $('#new_users_role').val();
    let skills = $('#new_users_skills').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'upload/required/modal/info',
        type: 'POST',
        data: {
            "role": role,
            "skills": skills
        },
        success: function (data) {
            console.log(data);
        }
    });
});

$('#third_modal_submit').click(function () {
    let about = $('#about_new_user').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'upload/required/modal/info',
        type: 'POST',
        data: {
            "about": about
        },
        success: function (data) {
            console.log(data);
        }
    });
});
