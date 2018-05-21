<?php
    session_start();
    include "../Controllers/UserController.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent Dresses</title>
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/header.css">
    <link rel="stylesheet" href="../Resources/css/style.css" type="text/css" media="all" />
</head>
<body>
<?php include "header.php";?>
<br><br><br><br><br><br>
<div class="container">

    <div class="contents">
        <div class="container loginblock">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                            </div>
                        </div>
                        <div class="panel-body" style="margin-top: ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" action="../Controllers/user_route.php" method="post" role="form" style="display: block;">

                                        <div class="form-group">
                                            <label class="text-primary" style="font-size: 50px">Facebook: </label>
                                            <p style="margin-left: 50px; font-size: 20px">www.facebook.com/rent_dresses</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" style="color: #00aced;font-size: 50px">Twitter: </label>
                                            <p style="margin-left: 50px; font-size: 20px">www.twitter.com/rent_dresses</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary" style="color: #bc2a8d;font-size: 50px">Instagram: </label>
                                            <p style="margin-left: 50px; font-size: 20px">www.instagram.com/rent_dresses</p>
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
<script src="../Resources/js/jquery.min.js"></script>
<script src="../Resources/js/bootstrap.min.js"></script>
</body>
</html>
