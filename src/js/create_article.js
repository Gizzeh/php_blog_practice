let picture = $('input[name="picture"]').change(function (e) {
    picture = e.target.files[0];
});

$(`input`).removeClass('error');


$('.create-article__button').click(function(e) {

    e.preventDefault();

    let title = $('#title'),
        category = $('#categories'),
        description = $('textarea[name="description"]'),
        content = $("#BBeditor").htmlcode();

    let formData = new FormData();

    formData.append('title', title.val());
    formData.append('category', category.val());
    formData.append('description', description.val());
    formData.append('content', content);
    formData.append('picture', picture);

    $.ajax({
        url: '../Controller/create_article_controller.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,

        success: function(data) {

            if (data.status) {
                document.location.href = '../View/main_page.php';
            }
            else {
                data.fields.forEach(field => $(`input[name="${field}"]`).addClass('error'));
                alert("Заполните все поля");
            }

        }
    });

});