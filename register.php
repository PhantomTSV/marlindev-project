<?php
require_once 'common.php';
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
        <?php require_once 'navbar.php'; ?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">

                                <?php if  (isset($_SESSION['flash_message'])) { ?> 
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $_SESSION['flash_message']; ?>
                                    </div>
                                <?php } ?>

                                <form method="POST" action="register_save.php">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control <?php 
                                            if (isset($_SESSION["validation_errors"]["name_invalid"])) { 
                                                echo "is-invalid"; 
                                            } 
                                        ?>" name="name" autofocus value="<?php echo @$_SESSION["post_data"]["name"]; ?>">
                                            <?php if (isset($_SESSION["validation_errors"]["name_invalid"])) { ?>
                                                <span class="invalid-feedback" role="alert">    
                                                    <strong><?php echo $_SESSION["validation_errors"]["name_invalid"]; ?></strong>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control <?php 
                                            if (isset($_SESSION["validation_errors"]["email_invalid"])) { 
                                                echo "is-invalid"; 
                                            } 
                                        ?>" name="email" value="<?php echo @$_SESSION["post_data"]["email"]; ?>">
                                            <?php if (isset($_SESSION["validation_errors"]["email_invalid"])) { ?>
                                                <span class="invalid-feedback" role="alert">    
                                                    <strong><?php echo $_SESSION["validation_errors"]['email_invalid']; ?></strong>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control <?php 
                                            if (isset($_SESSION["validation_errors"]["password_invalid"])) { 
                                                echo "is-invalid"; 
                                            } 
                                        ?>" name="password"  autocomplete="new-password" >
                                            <?php if (isset($_SESSION["validation_errors"]["password_invalid"])) { ?>
                                                <span class="invalid-feedback" role="alert">    
                                                    <strong><?php echo $_SESSION["validation_errors"]["password_invalid"]; ?></strong>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control <?php 
                                            if (isset($_SESSION["validation_errors"]["password_confirmation_invalid"])) { 
                                                echo "is-invalid"; 
                                            } 
                                        ?>" name="password_confirmation"  autocomplete="new-password"> 
                                                
                                            <?php if (isset($_SESSION["validation_errors"]["password_confirmation_invalid"])) { ?>
                                                <span class="invalid-feedback" role="alert">    
                                                    <strong><?php echo $_SESSION["validation_errors"]["password_confirmation_invalid"]; ?></strong>
                                                </span>
                                            <?php } ?>
                                                    
                                                
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php

unset($_SESSION["validation_errors"]);
unset($_SESSION["post_data"]);
unset($_SESSION["flash_message"]);

?>
