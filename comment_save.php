<?php
session_start();
require_once 'config.php';


$pdo = new PDO($db_dsn, $db_user, $db_password, $db_options); 


if (!empty($_POST["user_name"]) && !empty($_POST["message"])) {
	$sql = "INSERT INTO comment(user_name, message) VALUES(:user_name, :message)";
	$statement = $pdo->prepare($sql);
	$statement->execute($_POST);
	$_SESSION['flash_message'] = 'Комментарий успешно добавлен';
} else {


	if (empty($_POST["user_name"])) {
		$_SESSION['flash_user_name_is_empty'] = true;
	}  

	if (empty($_POST["message"])) {
		$_SESSION['flash_message_is_empty'] = true;
	}

	$_SESSION["user_name"] = $_POST["user_name"];
	$_SESSION["message"] = $_POST["message"];


}

header('Location: index.php');

?>