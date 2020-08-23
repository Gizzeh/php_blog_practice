<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: autorisation.php');
}
require_once "../Controller/article_controller.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>myBlogProject</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>

<body>
<?php
    require_once 'header.php';
?>

	<main class="main-article">
		<article class="main-article__block">
			<img src="<?php echo $article['picture']; ?>" alt="image" class="main-article__block_picture">
			<h2 class="main-article__block_title"><?php echo $article['title']; ?></h2>
			<div class="main-article__block_info">
				<p class="main-article__block_info_date"><?php echo $article['pubdate']; ?></p>
				<div class="main-article__block_info_views">
					<svg class="icon-views">
						<use xlink:href="../img/svg/sprite.svg#sid-view"></use>
					</svg>
					<p class="count-views"><?php echo $article['views']; ?></p>
				</div>
			</div>
			<div class="main-article__block_content">
				<?php echo $article['content']; ?>
			</div>
		</article>
		<article class="main-article__comments">
			<div class="main-article__comments_title">
				Комментарии
			</div>
			<form class="main-article__comments_form">
				<textarea name="comment" id="comment" class="main-article__comment_field"
					placeholder="Напишите комментарий"></textarea>
                <input name="article-id" value="<?php echo $article_id;?>" type="hidden">
				<input type="submit" class="main-article__comments_form_button" value="Отправить">
			</form>
            <?php foreach ($comments as $comment) {?>
                <div class="main-article__comments_user">
                    <img src="<?php echo $comment['user_avatar']; ?>" alt="avatar" class="comment-user-avatar">
                    <div class="comment-user-info">
                        <a href="profile.php?user=<?php echo $comment['user_id'];?>" class="comment-user-name"><?php echo $comment['user_nickname']; ?></a>
                        <p class="user-comment"><?php echo $comment['text']; ?></p>
                    </div>
                </div>
            <?php }?>

		</article>
	</main>

<?php require_once "footer.php";?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/comments.js"></script>
	<script src="../js/script.js"></script>
</body>

</html>