<?php
    //already login
    session_start();
    $register_error = "";

    if (isset($_GET['error'])){
        $register_error = $_GET['error'];
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
    <script src="../Resources/js/bootstrap.min.js"></script>
    <style>
        .alertmsg:empty{
            display: none;
        }
        textarea{
            resize: vertical;
        }
        #add-product-form span{
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
                                <form id="add-product-form" action="../Controllers/user_route.php" method="post" role="form"  enctype="multipart/form-data" onsubmit="">
                                    <div class="form-group">
                                        <h3 class="alert-success alertmsg"><?php echo $register_error;?></h3>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary" for="product_name">Product name : </label>
                                        <input type="text" name="name" id="product_name" tabindex="1" class="form-control" placeholder="Enter Name" required value="">
                                        <span id="name_feedback"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary" for="product_img">Product Image : </label>
                                        <input type="file" name="img" id="product_img" tabindex="1" class="form-control" placeholder="Email"required  value="">
                                        <span id="image_feedback"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary" for="product_price">Product price : </label>
                                        <input type="number" min="0" name="price" id="product_price" tabindex="2" class="form-control" placeholder="price">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-primary" for="product_desc">Product description : </label>
                                        <textarea  name="desc" id="product_desc"  class="form-control" placeholder="Description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="add_product" id="product-submit" tabindex="4" class="form-control btn btn-register" value="Add">
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
<script src="../Resources/js/addproduct.js"></script>
</html>

