<?php
session_start();
require_once 'config.php';


$pdo = new PDO($db_dsn, $db_user, $db_password, $db_options); 

$validation_errors = [];



if (empty($_POST["name"])) {
	$validation_errors['name_invalid'] = "Поле должно быть заполнено";
}


if (empty($_POST["email"])) {
	$validation_errors['email_invalid'] = "Поле должно быть заполнено";
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$validation_errors['email_invalid'] = "Email имеет неверный формат";
} else {
	$sql = "SELECT * FROM user WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->bindValue(':email', $_POST["email"]);
	$res = $statement->execute();

	if ($statement->rowCount() > 0) {
		$validation_errors['email_invalid'] = "Введенный Email уже используется";
	}
}


if (empty($_POST["password"])) {
	$validation_errors["password_invalid"] = "Поле должно быть заполнено";
} else if (strlen($_POST["password"]) < 6) {
	$validation_errors["password_invalid"] = "Пароль должен содержать не менее 6 символов";
}

if (empty($_POST["password_confirmation"])) {
	$validation_errors["password_confirmation_invalid"] = "Поле должно быть заполнено";
} else if ($_POST["password_confirmation"] != $_POST["password"]) {
	$validation_errors["password_confirmation_invalid"] = "Введеные пароли не совпадают";
}



if (count($validation_errors) == 0) {
	$sql = "INSERT INTO user(name, email, password) VALUES(:name, :email, :password)";
	$statement = $pdo->prepare($sql);
	unset($_POST['password_confirmation']);
	$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$statement->execute($_POST);
	$_SESSION['flash_message'] = 'Вы успешно зарегистрированы. Теперь вы можите зайти на сайт под своим логином и паролем.';
} else {
	$_SESSION["validation_errors"] = $validation_errors;
	$_SESSION["post_data"] = $_POST;
}

header('Location: register.php');



?>