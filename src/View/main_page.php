<?php
session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: autorisation.php');
    }
    require_once "../Controller/main_page_controller.php";
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
	<?php require_once 'header.php';?>

	<main class="main">
		<article class="sidebar">
			<div class="sidebar__last-comment">
				<h2 class="sidebar__last-comment_maintitle">Последний комментарий</h2>
				<a href="article_page.php?article=<?php echo $last_comment['article']['id']; ?>" class="sidebar__last-comment-title"><?php echo $last_comment['article']['title']; ?></a>
				<div class="sidebar__last-comment_user">
					<img src="<?php echo $last_comment['user']['avatar']; ?>" alt="аватар" class="sidebar__last-comment_user-avatar comment-avatar">
					<div>
						<a href="profile.php?user=<?php echo $last_comment['user_id']; ?>" class="sidebar__last-comment_nickname nickname"><?php echo $last_comment['user']['nickname']; ?></a>
						<p class="sidebar__last-comment_content"><?php echo $last_comment['text']; ?></p>
					</div>
				</div>
			</div>
			<div class="sidebar__new-user">
				<h2 class="sidebat__new-user_title">Новый пользователь</h2>
				<div class="sidebar__new-user_link">
					<img src="<?php echo $new_user['avatar']; ?>" alt="аватар" class="sidebar__new-user_user-avatar comment-avatar">
					<div>
						<a href="profile.php?user=<?php echo $new_user['id']; ?>" class="sidebar__new-user_nickname nickname"><?php echo $new_user['nickname']; ?></a>
						<p class="sidebar__new-user_registration-time">Зарегистрировался: <?php echo $new_user['registration_date']; ?></p>
					</div>
				</div>
			</div>
		</article>

		<article class="blog">
            <?php if (empty($articles)) echo "<p class='nothing-find'>Ничего нет :(</p>";?>
            <?php foreach ($articles as $article) { ?>
                <div class="blog__article">
                    <a href="article_page.php?article=<?php echo $article['id']; ?>" class="blog__article_link"></a>
                    <div class="blog__content">
                        <h2 class="blog__content_title"><?php echo $article['title']; ?></h2>
                        <p class="blog__content_subtitle"><?php echo $article['description']; ?></p>
                    </div>
                    <img src="<?php echo $article['picture']; ?>" alt="image" class="blog__picture">
                </div>
            <?php } ?>
		</article>
	</main>
    <div class="pagination">
        <div class="pagination__block" page="0"><<</div>
        <?php foreach ($pagination_element as $element) { ?>
            <div class="pagination__block" page="<?php echo $element;?>"><?php echo $element + 1; ?></div>
        <?php } ?>
        <div class="pagination__block" page="<?php echo $pagination_block_count; ?>">>></div>
    </div>
	<?php require_once "footer.php";?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/main-page.js"></script>
	<script src="../js/script.js"></script>
</body>

</html>