<?php
//already login
session_start();
if (isset($_SESSION['username'])){
    header("Location: index.php");
}
$error = "";$register_error = "";
if (isset($_GET['error'])){
    $error = "Wrong email or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/header.css">
    <link rel="stylesheet" href="../Resources/css/home.component.css">
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/bootstrap.min.js"></script>
    <script src="../Resources/js/login.js"></script>
    <style>
        .alertmsg:empty{
            display: none;
        }
    </style>
</head>
<body>
<?php include "header.php"?>
<div class="blur-body"></div>
<div class="contents">
    <div class="container loginblock">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <h3 class="alert-danger alertmsg"><?php echo $error?></h3>
                                </div>
                                <form id="login-form" action="../Controllers/user_route.php" method="post" role="form" style="display: block;">

                                    <div class="form-group">
                                        <input type="text" name="username" autocomplete="no" id="username" tabindex="1" class="form-control" placeholder="Enter your email" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Enter your password" required>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <a href="signup.php">
                                                    <input type="button" name="login-submit" id="register-submit"  tabindex="4" class="form-control btn btn-login" value="Register" >
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

