<?php
    session_start();
    require "../Controllers/UserController.php";
    $user = new UserController();
    $questions = $user->getAllQuestions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent Dresses</title>
    <link rel="stylesheet" href="../Resources/css/header.css">
    <link rel="stylesheet" href="../Resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Resources/css/students.css">
    <link rel="stylesheet" href="../Resources/css/style.css" type="text/css" media="all" />
</head>
<body>
<?php
    include "header.php";
?>


<div class="table-container col-md-12 col-md-offset-0">
    <table class="table " >
        <thead>
        <tr>
            <th class="col-xs-2">Question</th>
            <th class="col-xs-1">Answer</th>

        </tr>
        </thead>
        <tbody >
        <?php if (!isset($_SESSION['username'])){
            echo "<button style=\"margin-left: 50px ; float: left; margin-bottom: 20px\"  onclick=\"document.getElementById('question').style.display = '' \" class=\"btn btn-primary\">Add question </button>
                        <input name=\"question\"  class=\"input-sm col-lg-6\"  id=\"question\" style=\"margin-left: 20px;display: none\" type=\"text\">                    
               ";
        }?>

        <?php
            if ($questions){
                while ($row = mysqli_fetch_assoc($questions)){
                    if (empty($row['answer']) && !isset($_SESSION['username'])){
                        $row['answer'] = "Waiting for answer";
                    }else if (empty($row['answer']) && isset($_SESSION['username'])){
                        $row['answer'] = "<form id=\"answer{$row['id']}\" method='post' action='../Controllers/user_route.php'>
                                    <input class='input-sm' name='answer' placeholder='Add answer here' type='text'>
                                    <input name='id' hidden value='{$row['id']}'>
                                    <input type='submit' hidden name='add-answer'>
                                </form>";
                    }
                    echo "<tr id='question{$row['id']}'>
                            <td class=\"col-xs-2\"><h4>{$row['question']}</h4></td>
                            <td class=\"col-xs-1\"><h4>{$row['answer']}</h4></td>
                         </tr>";

                }
            }
        ?>
        </tbody>
    </table>
</div>


<script src="../Resources/js/jquery.min.js"></script>
<script src="../Resources/js/bootstrap.min.js"></script>
<script src="../Resources/js/questions.js"></script>
</body>
</html>
