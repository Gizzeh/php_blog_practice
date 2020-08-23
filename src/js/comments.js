$('.main-article__comments_form_button').click(function(e) {
    e.preventDefault();

    let comment = $('textarea[name="comment"]');
    let article_id = $('input[name="article-id"]');


    $.ajax({
        url: '../Controller/comments_controller.php',
        type: 'POST',
        dataType: 'json',
        data: {
            comment: comment.val(),
            article_id: article_id.val()
        },

        success: function(data) {

            if (data.status) {
                document.location.reload();
            }
        }
    });
});