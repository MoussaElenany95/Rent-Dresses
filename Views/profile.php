<?php
    //already login
    session_start();

    $register_error = "";

    if (isset($_GET['update']) && $_GET['update']=="true" ){
        $register_error = "<h3 class=\"alert-success alertmsg\">Profile successfully updated !</h3>";

    }elseif (isset($_GET['update']) && $_GET['update']=="false"){

        $register_error = "<h3 class=\"alert-danger alertmsg\">Email is already taken !</h3>";

    }

    include "../Controllers/UserController.php";
    $user     = new UserController();

    $userInfo = NULL;
    if (isset($_GET['email'])){
        $userInfo = $user->searchForUser($_GET['email']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../Resources/css/header.css">
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/home.component.css">
    <link rel="stylesheet" href="../Resources/css/style.css" type="text/css" media="all" />
    <script src="../Resources/js/jquery.min.js"></script>
    <title>Rent-Dresses</title>
    <script src="../Resources/js/bootstrap.min.js"></script>
    <style>
        .alertmsg:empty{
            display: none;
        }
        #update-form span{
            color: red;
        }
    </style>

</head>
<body>
<?php
    include "header.php";
?>
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
                                <form id="update-form" action="../Controllers/user_route.php" method="post" role="form" >
                                    <div class="form-group">
                                        <?php echo $register_error?>
                                    </div>
                                    <input type="hidden" name="oldemail" id="oldEmail" value="<?php echo $userInfo['email']?>" >
                                    <div class="form-group">
                                        <label class="text-primary">Name</label>
                                        <input type="text" name="name" id="register_name" tabindex="1" value ="<?php echo  $userInfo['name'];?>"class="form-control" placeholder="Enter Name" required value="">
                                        <span id="name_feedback"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary">Email</label>
                                        <input type="email" name="email" id="register_email" value="<?php echo  $userInfo['email'];?>"tabindex="1" class="form-control" placeholder="Email"required  value="">
                                        <span id="email_feedback"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">password</label>
                                        <input type="password" value="##$ggg@1444" name="password" id="register_password" tabindex="2" class="form-control" placeholder="Enter Password">
                                        <span id="password_feedback"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Phone</label>
                                        <input type="number" min="0" value="<?php echo $userInfo['phone'];?>" name="telephone" id="register_password" tabindex="2" class="form-control" placeholder="phone">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="update-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Update">
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
<script src="../Resources/js/profile.js"></script>
</body>
</html>

