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
</head>

<body class="fullpage">
<?php require_once 'header.php';?>

	<main class="profile-settings">
		<form class="profile-settings__form">
			<div class="profile-settings__flex">
				<div class="profile-settings__form_top-left">
					<label for="login" class="profile-settings__label">Логин (никнейм)</label>
					<input type="text" class="profile-settings__field" name="login" value="<?php echo $_SESSION['user']['nickname'];?>">
					<label for="email" class="profile-settings__label">Почта</label>
					<input type="text" class="profile-settings__field" name="email" value="<?php echo $_SESSION['user']['email'];?>">
					<label for="password" class="profile-settings__label">Текущий пароль</label>
					<input type="password" class="profile-settings__field" name="password">
					<label for="new-password" class="profile-settings__label">Новый пароль</label>
					<input type="password" class="profile-settings__field" name="new-password">
				</div>
				<div class="profile-settings__form_top-right">
					<label for="avatar" class="profile-settings__label">Аватар</label>
					<input type="file" name="avatar" class="file-input">
					<img src="<?php echo $_SESSION['user']['avatar'];?>" alt="avatar" class="profile-settings__form_avatar">
				</div>
			</div>
			<label for="about" class="profile-settings__label">О себе</label>
			<textarea name="about" id="about" class="profile-settings__form_about"
				placeholder="Напишите что-нибудь о себе"><?php if (!is_null($_SESSION['user']['about'])) echo $_SESSION['user']['about'];?></textarea>
			<input type="submit" class="profile-settings__form_button" value="Сохранить">
		</form>
	</main>

    <?php require_once "footer.php";?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/profile_settings.js"></script>
	<script src="../js/script.js"></script>
</body>

</html>