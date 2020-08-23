let avatar = $('input[name="avatar"]').change(function (e) {
    avatar = e.target.files[0];
});


$('.profile-settings__form_button').click(function(e) {

    e.preventDefault();

    let login = $('input[name="login"]'),
        email = $('input[name="email"]'),
        password = $('input[name="password"]'),
        new_password = $('input[name="new-password"]'),

        about = $('textarea[name="about"]');

    $(`input`).removeClass('error');

    let formData = new FormData();

    formData.append('login', login.val());
    formData.append('email', email.val());
    formData.append('password', password.val());
    formData.append('new_password', new_password.val());
    formData.append('avatar', avatar);
    formData.append('about', about.val());

    $.ajax({
        url: '../Controller/profile_settings_controller.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,

        success: function(data) {

            if (data.status) {
                document.location.reload();
            }
            else {
                $(`input[name="${data.error}"]`).addClass('error');
            }
        }
    });

});