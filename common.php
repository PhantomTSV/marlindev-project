<?php
require_once 'config.php';
$pdo = new PDO($db_dsn, $db_user, $db_password, $db_options);

session_start();

function check_authorization() {
	global $pdo;
		

	if (!empty($_SESSION["user_id"])) {
	    
	    $sql = "SELECT * FROM user WHERE id=:id";
	    $statement = $pdo->prepare($sql);
	    $statement->bindValue(':id', $_SESSION["user_id"]);
	    $statement->execute();
	    return $statement->fetch(PDO::FETCH_ASSOC);
	} else if ( !empty($_COOKIE['email']) && !empty($_COOKIE['password'])  ) {

		$sql = "SELECT * FROM user WHERE email=:email AND password=:password";
	    $statement = $pdo->prepare($sql);
	    $statement->bindValue(':email', $_COOKIE["email"]);
	    $statement->bindValue(':password', $_COOKIE["password"]);
	    $statement->execute();

	    if ($user = $statement->fetch(PDO::FETCH_ASSOC)) {
	    	$_SESSION['user_id'] = $user["id"];
	    	return $user;
	    }

	}

	return NULL;
}


$current_user = check_authorization();