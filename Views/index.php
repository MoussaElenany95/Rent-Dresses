<?php
    session_start();
    include "../Controllers/UserController.php";

    $user     = new UserController();
    //get number of pages
    $numberOfPages = ceil($user->countProducts()/7);

    if (isset($_GET['page'])){

        $page = $_GET['page'];
        if (!filter_var($page,FILTER_VALIDATE_INT) || $page > $numberOfPages || $page < 1){
            die(http_response_code(404));
        }
    }else{
        $page  = 0;
    }

    if ($page == "" || $page == 1){

        $page_1 = 0;

    }else{
        $page_1 = ( $page * 7 ) - 7;
    }

    $search_hint = "";
    if (isset($_GET['search'])){
        $search = $_GET['search'];
        $search_hint = '<h3 class="text-primary">Search results "'.$search.'" : </h3>';
        $products = $user->searchForProducts($search);
    }else{

        $products = $user->getAllProducts($page_1);

    }
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
<div class="light-box">
    <div class="details">
        <table>
            <tr>
                <td rowspan="5"><img src=""></td>
            </tr>
            <tr>
                <td id="name"></td>
            </tr>
            <tr>
                <td id="price"></td>
            </tr>
            <tr>
                <td>
                    <button class="btn" id="order-btn">Order now</button>
                </td>
            </tr>
        </table>
    </div>

</div>
<?php include "index-header.php";?>
        <div class="title col-md-4 col-md-offset-4">
            <h1>Welcome</h1>
            <h3>Here there are beautiful dresses </h3>
        </div>
        <div class="container">
            <div id="content">
                <div class="box">
                    <?php
                    echo $search_hint;
                    $ID = 0;
                    while ($product = $products->fetch_assoc()){
                        echo "<div id='product{$product['id']}'><div class=\"movie\">
                           <div class=\"movie-image\">
                               <span><div class='show-details'>Show details</div><img src=\"{$product['img']}\"></span>
                                <span class='name'>{$product['name']}</span>
                                <span class='price'>{$product['price']} SAR</span></div>
                               ";
                        if (isset($_SESSION['username'])){
                            echo "<button onclick=\"location.href ='update_product.php?id={$product['id']}'\" class=\"btn-primary btn\">Edit</button> <button data-toggle=\"modal\" data-target=\"#$ID\" class=\"btn-primary btn\">Delete</button>";
                        }else{
                            echo "<button onclick=\"location.href = 'make_order.php?id={$product['id']}&price={$product['price']}'\" class=\"btn - primary btn\">Order now</button>";
                        }
                        echo "</div>";
                        echo " <div class=\"modal fade\" id=\"$ID\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                                    <div class=\"modal-dialog\" role=\"document\">
                                        <div class=\"modal-content\">
                                             <div class=\"modal-header\">
                                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                                <h4 class=\"modal-title\" id=\"myModalLabel\">Confirm deletion</h4>
                                             </div>
                                             <div class=\"modal-body\">
                                               Reject Product : {$product['name']} 
                                             </div>
                                             <div class=\"modal-footer\">
                                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                                                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-primary delete-product\" value='{$product['id']}'>Delete</button>
                                             </div>
                                        </div>
                                     </div>
                                </div></div>";
                        $ID++;
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="pages">
            <nav>
                <ul class="pagination">
                   <?php
                        for ($i = 1 ; $i <= $numberOfPages ; $i++){
                            if ($i == $page){
                                echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"?page={$i}\">$i</a></li>";

                            }else{
                                echo "<li class=\"page-item \"><a class=\"page-link\" href=\"?page={$i}\">$i</a></li>";

                            }

                        }
                   ?>

                </ul>
            </nav>
        </div>

<script src="../Resources/js/jquery.min.js"></script>
<script src="../Resources/js/index.js"></script>
<script src="../Resources/js/bootstrap.min.js"></script>
</body>
</html>
