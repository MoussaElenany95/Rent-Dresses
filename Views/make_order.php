<?php
session_start();

$error = "";
if (isset($_GET['error']) && $_GET['error'] == "false"){
   $error = "<h3 class=\"alert-success alertmsg\">Your order have been sent</h3>";
}else if (isset($_GET['error']) && $_GET['error'] == "false"){
    $error = "<h3 class=\"alert-danger alertmsg\">Error while sent order , try again later :(</h3>";

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
    <script src="../ResourcesE/js/bootstrap.min.js"></script>
    <script src="../Resources/js/login.js"></script>
    <style>
        .alertmsg:empty{
            display: none;
        }
    </style>
</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent Dresses</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/home.component.css">
    <link rel="stylesheet" href="../Resources/css/header.css">

</head>
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
                                    <?php echo  $error?>
                                </div>
                                <form id="login-form" action="../Controllers/user_route.php" method="post" role="form" style="display: block;">
                                    <input type="hidden" name="product_id" value="<?php echo $_GET['id'];?>">
                                    <div class="form-group">
                                        <label class="text-primary">Your name : </label>
                                        <input type="text" name="name" autocomplete="no" id="username" tabindex="1" class="form-control" placeholder="Enter your email" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Your phone : </label>
                                        <input type="number" min="0" name="phone" autocomplete="no" id="username" tabindex="1" class="form-control" placeholder="Enter your phone" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Your Address</label>
                                        <input type="text"  name="address" autocomplete="no" id="username" tabindex="1" class="form-control" placeholder="Enter your address " value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Amount</label>
                                        <input type="number"  onkeyup="calcTotal()"  value="1"  min="1" id="amount" tabindex="2" class="form-control" placeholder="Enter amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary">Total price</label>
                                        <br>
                                        <input readonly id="totalprice" name="total"> SAR
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="make-order" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Order Now" >
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
<script>

    price = <?php echo $_GET['price']?>;

    document.getElementById('totalprice').value = price ;
    function calcTotal() {
        var amount = document.getElementById('amount').value;

        document.getElementById('totalprice').value = price * amount ;



    }
</script>
</html>

