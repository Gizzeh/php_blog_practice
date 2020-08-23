$('.registration__button').click(function(e) {

   e.preventDefault();

   let login = $('input[name="login"]'),
       email = $('input[name="email"]'),
       password = $('input[name="password"]'),
       confirm_password = $('input[name="confirm-password"]');

   $(`input`).removeClass('error');
   $('.error_msg').addClass('hide');


    $.ajax({
        url: '../Controller/registration_controller.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login.val(),
            email: email.val(),
            password: password.val(),
            confirm_password: confirm_password.val()
        },

        success: function(data) {

            if (data.status) {
                alert("Регистрация прошла успешно");
                document.location.href = '../View/autorisation.php';
            }
            else {
                switch (data.fields.type) {
                    case 'all':
                        $(`input`).addClass('error');
                        break;

                    case 'login':
                        login.addClass('error');
                        break;

                    case 'email':
                        email.addClass('error');
                        break;

                    case 'password':
                        password.addClass('error');
                        confirm_password.addClass('error');
                        break;
                }

                $('.error_msg').removeClass('hide').text(data.fields.msg);
            }

        }
    });

});