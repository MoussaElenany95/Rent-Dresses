<?php
    //already login
    session_start();
    if (isset($_SESSION['username'])){
        header("Location:index.php");
    }

    $register_error = "";

    if (isset($_GET['register_error'])){
        $register_error = "Email is already taken !";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/home.component.css">
    <link rel="stylesheet" href="../Resources/css/header.css">
    <script src="../Resources/js/jquery.min.js"></script>
    <title>Rent Dresses</title>
    <script src="../Resources/js/bootstrap.min.js"></script>
    <style>
        .alertmsg:empty{
            display: none;
        }
        form span{
            color: red;
        }
    </style>
   </head>
<body>
<?php
    include "header.php";
?>
<div class="blur-body"></div>
<div class="contents">
    <div class="container loginblock">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="register-form" action="../Controllers/user_route.php" method="post" role="form">
                                    <div class="form-group">
                                        <h3 class="alert-danger alertmsg"><?php echo $register_error;?></h3>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="name" id="register_name" tabindex="1" class="form-control" placeholder="Enter Name" required value="">
                                        <span id="name_feedback" ></span>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" id="register_email" tabindex="1" class="form-control" placeholder="Email"required  value="">
                                        <span id="email_feedback" ></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="register_password" tabindex="2" class="form-control" placeholder="Enter Password">
                                        <span id="password_feedback" ></span>
                                    </div>


                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password"   tabindex="2" class="form-control"  required placeholder="Confirm password">
                                        <span id="confirm_feedback" ></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" min="0" name="telephone" id="register_phone" tabindex="2" class="form-control" placeholder="phone">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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
    </div>
</div>

</body>
<script src="../Resources/js/sign_up.js"></script>
</html>

