<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: autorisation.php');
}
    require_once "../Controller/profile_controller.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>myBlogProject</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>

<body class="fullpage">
<?php require_once 'header.php';?>

	<main class="profile">
		<div class="profile__avatar-and-info">
			<img src="<?php echo $user['avatar']; ?>" alt="avatar" class="profile__avatar">
			<div class="profile__info">
				<p class="profile__nickname"><?php echo $user['nickname']; ?></p>
				<p class="profile__date">Дата регистрации <?php echo $user['registration_date']; ?></p>
				<a href="main_page.php?user=<?php echo $user['id']; ?>&page=0" class="profile__auter-articles">Статьи</a>
			</div>
		</div>
		<div class="profile__about">
			<h2 class="profile__about_title">О себе</h2>
			<p class="profile__about_content"><?php echo $user['about'] ?></p>
		</div>
	</main>

<?php require_once "footer.php";?>

	<script src="../js/script.js"></script>
</body>

</html>