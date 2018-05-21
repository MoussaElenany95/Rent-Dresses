<?php
    //already login
    session_start();


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
    <title>Ptoductive family</title>
    <script src="../Resources/js/bootstrap.min.js"></script>
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
                                <form id="register-form" action="../Controllers/user_route.php" method="post" role="form" onsubmit="return checkPassword()">
                                    <div class="form-group">
                                        <label class="text-primary">Name</label>
                                        <input  readonly type="text" name="name" id="register_name" tabindex="1" value ="<?php echo  $userInfo['name'];?>"class="form-control" placeholder="Enter Name" required value="">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary">Email</label>
                                        <input  readonly type="email" name="email" id="email" value= "<?php echo  $userInfo['email'];?>"tabindex="1" class="form-control" placeholder="Email"required  value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Phone</label>
                                        <input type="number" readonly min="0" value="<?php echo $userInfo['phone'];?>" name="telephone" id="register_password" tabindex="2" class="form-control" placeholder="phone">
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
</html>

