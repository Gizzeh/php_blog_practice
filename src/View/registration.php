<!doctype html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Registration</title>
</head>

<body class="fullscreen">
	<header class="registration_header">
		<p class="registration_header__title">myBlogProject</p>
	</header>
	<form class="registration">
		<label for="login">Логин</label>
		<input type="text" class="registration__field" name="login" placeholder="Введите логин" id="login">
		<label for="email">Email</label>
		<input type="email" class="registration__field" name="email" placeholder="Введите email" id="email">
		<label for="password">Пароль</label>
		<input type="password" class="registration__field" name="password" placeholder="Введите пароль" id="password">
		<label for="confirm-password">Подтвердите пароль</label>
		<input type="password" class="registration__field" name="confirm-password" placeholder="Подтвердите пароль"
			id="confirm-password">
        <p class="error_msg hide"></p>
		<input type="submit" value="Зарегистрироваться!" class="registration__button">
	</form>
	<p class="relocate">Уже есть аккаунт? <a class="relocate__link" href="../View/autorisation.php">Авторизируйтесь!</a></p>
	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/registration.js"></script>
	<script src="../js/script.js"></script>
</body>

</html>