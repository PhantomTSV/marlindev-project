<?php
session_start();
require_once 'config.php';


$pdo = new PDO($db_dsn, $db_user, $db_password, $db_options); 



$validation_errors = [];


if (empty($_POST["email"])) {
	$validation_errors['email_invalid'] = "Поле должно быть заполнено";
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$validation_errors['email_invalid'] = "Email имеет неверный формат";
} 

if (empty($_POST["password"])) {
	$validation_errors["password_invalid"] = "Поле должно быть заполнено";
} 

if (count($validation_errors) == 0) {
	$sql = "SELECT * FROM user WHERE email=:email";
	$statement = $pdo->prepare($sql);
	$statement->bindValue(':email', $_POST["email"]);
	$statement->execute();


	if ($user = $statement->fetch(PDO::FETCH_ASSOC)) {
		if (password_verify( $_POST["password"], $user["password"] )) {
			$_SESSION["user_id"] = $user["id"];
			header('Location: index.php');
			exit();
		}
	}

	$_SESSION['flash_message'] = 'Введены неверные Email или пароль.';
} 

$_SESSION["validation_errors"] = $validation_errors;
$_SESSION["post_data"] = $_POST;


header('Location: login.php');

