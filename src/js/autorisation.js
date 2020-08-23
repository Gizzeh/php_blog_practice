$('.login-button').click(function(e) {

    e.preventDefault();

    let login = $('input[name="login"]'),
        password = $('input[name="password"]');

    login.removeClass('error');
    password.removeClass('error');

    $('.error_msg').addClass('hide');

    $.ajax({
        url: '../Controller/autorisation_controller.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login.val(),
            password: password.val(),
        },

        success: function(data) {

            if (data.status) {
                document.location.href = '../View/main_page.php';
            }
            else {
                login.addClass('error');
                password.addClass('error');
                $('.error_msg').removeClass('hide').text(data.msg);
            }
        }
    });

});