<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: autorisation.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>myBlogProject</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://cdn.wysibb.com/js/jquery.wysibb.min.js"></script>
	<link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" />
	<script src="../js/lang/ru.js"></script>
</head>

<body class="fullpage">
<?php require_once 'header.php';?>

	<main class="create-article">
		<h2 class="create-article__title">Создать статью</h2>
		<form class="create-article__form">
			<div class="create-article__grid">
				<div class="create-article__grid_left">
					<label for="title" class="create-article__lable">Название</label>
                        <input type="text" class="create-article__field" name="title" placeholder="Название статьи" id="title">
					<label for="categories" class="create-article__lable">Выберите категорию</label>
					<select name="categories" id="categories" class="create-article__select">
                        <?php
                            foreach ($categories as $category) {
                                echo "<option value=".$category['id'].">".$category['title']."</option>";
                            }
                        ?>
					</select>
				</div>
				<div class="create-article__grid_right">
					<label for="picture" class="create-article__lable">Загрузите картинку</label>
					<input type="file" class="create-article__picture" name="picture" id="picture">
				</div>
			</div>
			<div class="create-article__flex_column">
				<label for="description" class="create-article__lable">Напишите краткое описание</label>
				<textarea name="description" id="description" placeholder="Не более 2-3 предложений, характирезующих статью"
					class="create-article__description"></textarea>
			</div>
			<div>
				<label for="BBeditor" class="create-article__lable">Содержание статьи</label>
				<textarea name="content" class="create-article__content" id="BBeditor"></textarea>
			</div>
			<div class="create-article__flex_center"><input type="submit" class="create-article__button"
					value="Сохранить"></div>
		</form>
	</main>

    <?php require_once "footer.php";?>

	<script src="../js/script.js"></script>
	<script src="../js/BBCodeSettings.js"></script>
    <script src="../js/create_article.js"></script>
</body>

</html>