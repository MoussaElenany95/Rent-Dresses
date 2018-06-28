<?php
    //already login
    session_start();
    $register_error = "";

    if (isset($_GET['error'])){
        $register_error = $_GET['error'];
    }

    include "../Controllers/UserController.php";
    $user    = new UserController();

    if (isset($_GET['id'])){
        $product = $user->searchForProduct($_GET['id']);
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
    <style>
        .alertmsg:empty{
            display: none;
        }
        textarea{
            resize: vertical;
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
                                <form id="register-form" action="../Controllers/user_route.php" method="post" role="form"  enctype="multipart/form-data" onsubmit="">
                                    <input type="hidden" name="id" value="<?php echo $product['id'];?>">
                                    <div class="form-group">
                                        <h3 class="alert-success alertmsg"><?php echo $register_error;?></h3>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary" >Name</label>
                                        <input type="text" name="name" value="<?php echo $product['name'] ;?>"id="register_name" tabindex="1" class="form-control" placeholder="Enter Name" required value="">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary" >Image</label>
                                        <input type="file" name="img" id="email" tabindex="1" class="form-control" placeholder="Email"  value="">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary" >Price</label>
                                        <input required type="number" min="0" value="<?php echo $product['price'];?>" name="price" id="register_password" tabindex="2" class="form-control" placeholder="price">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary" >Description</label>
                                        <textarea name="dsc" class="form-control"></textarea>
                                    </div>
                                        <input type="hidden" value="<?php echo $product['img']?>" name="oldimg">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="update-product" id="update-product" tabindex="4" class="form-control btn btn-register" value="Update">
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
</html>

