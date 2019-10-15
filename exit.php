<?php
session_start();
unset($_SESSION["user_id"]);
setcookie("email", $_POST["email"], -1);
setcookie("password", $_POST["password"], -1);
header('Location: index.php');
