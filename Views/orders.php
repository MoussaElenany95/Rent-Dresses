<?php
    session_start();
    require "../Controllers/UserController.php";
    $user = new UserController();
    //reject order
    if (isset($_GET['accept'])){
        $id = $_GET['id'];
        $user->acceptOrder($id);
    }
    //reject order
    if (isset($_GET['delete'])){
        $id = $_GET['id'];
        $user->rejectOrder($id);
    }
    //get all orders
    $allOrders = $user->getAllOrders();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productive Family</title>
    <link rel="stylesheet" href="../Resources/css/header.css">
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/students.css">
    <link rel="stylesheet" href="../Resources/css/style.css" type="text/css" media="all" />
    <script>

        function search() {

            var  s = document.getElementById("search").value;
            if (s !== ""){
                location.href= "?search="+s;
            }

        }
    </script>
</head>
<body>
<?php
    include "header.php";
?>


<div class="table-container col-md-12 col-md-offset-0">
    <table class="table " >
        <thead>
        <tr>
            <th class="col-xs-1">ID</th>
            <th class="col-xs-2">Product Name</th>
            <th class="col-xs-1">Customer Name</th>
            <th class="col-xs-1">Customer Phone</th>
            <th class="col-xs-1">Customer Location</th>
            <th class="col-xs-1">Date</th>
            <th class="col-xs-1">Total</th>
            <th class="col-xs-1">Operations</th>

        </tr>
        </thead>
        <tbody >

        <?php
        if ($allOrders){
            $ID = 0;
            while ($row = mysqli_fetch_assoc($allOrders)){

                echo "<tr>
                        <td class=\"col-xs-1\">{$row['id']}</td>
                        <td class=\"col-xs-2\">{$row['product_name']}</td>
                        <td class=\"col-xs -2\">{$row['customer_name']}</td>
                        <td class=\"col-xs-1\">{$row['customer_phone']}</td>
                        <td class=\"col-xs-1\">{$row['customer_location']}</td>                        
                        <td class=\"col-xs-1\">{$row['date']}</td>
                        <td class=\"col-xs-1\">{$row['total']}</td>
                        <td class=\"col-xs-1\">
                            <button data-toggle=\"modal\" data-target=\"#$ID\" class=' btn-primary btn'>Reject</button>
                        </td>
                         </tr>";


                        echo "
                        <div class=\"modal fade\" id=\"$ID\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                            <div class=\"modal-dialog\" role=\"document\">
                            <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <h4 class=\"modal-title\" id=\"myModalLabel\">Confirm deletion</h4>
                                </div>
                                <div class=\"modal-body\">
                                    Reject Order with id : {$row['id']} 
                                </div>
                                <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-default\"  data-dismiss=\"modal\">Cancel</button>
                                <button type=\"button\" class=\"btn btn-primary\" onclick=\"location.href='?delete=true&id={$row['id']}'\">Delete</button>
                                </div>
                            </div>
                            </div>
                        </div>";
                $ID++;
            }
        }
        ?>
        </tbody>
    </table>
</div>


<script src="../Resources/js/jquery.min.js"></script>
<script src="../Resources/js/bootstrap.min.js"></script>
</body>
</html>
