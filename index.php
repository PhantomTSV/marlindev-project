<?php
session_start();
date_default_timezone_set();
require_once 'config.php';

$pdo = new PDO($db_dsn, $db_user, $db_password, $db_options); 

$sql = "SELECT * FROM comment ORDER BY pub_date DESC";
$statement = $pdo->prepare($sql);
$statement->execute();
$comments = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">

                              <?php if  (isset($_SESSION['flash_message'])) { ?> 
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['flash_message']; ?>
                                </div>
                              <?php } ?>

                              <?php if  (isset($_SESSION['flash_user_name_is_empty']) || isset($_SESSION['flash_message_is_empty'])) { ?> 
                                <div class="alert alert-danger" role="alert">
                                    Ваш комментарий не был добвлен, проверте введеные данные
                                </div>
                              <?php } ?> 

                              <?php foreach ($comments as $comment) { ?>
                                <div class="media">
                                  <img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $comment['user_name']; ?></h5> 
                                    <span><small><?php echo(date('d/m/Y',  strtotime($comment['pub_date']))); ?></small></span>
                                    <p>
                                        <?php echo $comment['message']; ?>
                                    </p>
                                  </div>
                                </div>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header"><h3>Оставить комментарий</h3></div>

                            <div class="card-body">
                                <form action="comment_save.php" method="post">
                                    <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Имя</label>
                                    <input name="user_name" class="form-control <?php 
                                            if (isset($_SESSION["flash_user_name_is_empty"])) { 
                                                echo 'is-invalid'; 
                                            } 
                                        ?>" id="exampleFormControlTextarea1" value="<?php echo @$_SESSION['user_name']; ?>" />
                                    <span class="invalid-feedback" role="alert"><strong>Поле должно быть заполнено</strong></span>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение</label>
                                    <textarea name="message" class="form-control 
                                        <?php 
                                            if (isset($_SESSION["flash_message_is_empty"])) { 
                                                echo 'is-invalid'; 
                                            } 
                                        ?>" id="exampleFormControlTextarea1" rows="3"><?php echo @$_SESSION['message']; ?></textarea>
                                    <span class="invalid-feedback" role="alert"><strong>Поле должно быть заполнено</strong></span>
                                  </div>
                                  <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php

unset($_SESSION['flash_message']);
unset($_SESSION['flash_user_name_is_empty']);
unset($_SESSION['flash_message_is_empty']);
unset($_SESSION['user_name']);
unset($_SESSION['message']);

?>
