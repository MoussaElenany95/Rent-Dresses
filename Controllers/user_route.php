<?php

    require "UserController.php";
    $user = new UserController();
    //start new session;
    session_start();
    //login
    if (isset($_POST['login-submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $userData = $user->login($username,$password);
        if ($userData){
            $_SESSION['username'] = $userData['name'];
            $_SESSION['email']    = $userData['email'];
            header("Location:../Views/index.php");


        }else{
            header("Location:../Views/login.php?error=true");
        }


    }
    //sign up
    if (isset($_POST['register-submit'])){
        $data['name']           = $_POST['name'];
        $data['email']          = $_POST['email'];
        $data['password']       = $_POST['password'];
        $data['telephone']      = $_POST['telephone'];
        $data['type']           = $_POST['type'];
        if ($user->signUp($data)){
           $_SESSION['username'] = $data['name'];
           $_SESSION['email']    = $data['email'];
            header("Location:../Views/index.php");
        }else{
            header("Location:../Views/signup.php?register_error=true");
        }
    }

    //update profile
    if (isset($_POST['update-submit'])){
        $data['name']           = $_POST['name'];
        $data['email']          = $_POST['email'];
        $data['password']       = $_POST['password'];
        $data['telephone']      = $_POST['telephone'];
        $data['oldemail']       = $_POST['oldemail'];

        if ($user->updateUser($data)){
            header("Location: ../Views/profile.php?email={$data['email']}&update=true");
        }else{
            header("Location: ../Views/profile.php?email={$data['oldemail']}&update=false");

        }
    }
    //add product
    if (isset($_POST['add_product'])){
        $data['name']  = $_POST['name'];
        $data['type']  = $_POST['type'];
        $data['img']   = $_FILES['img'];
        $data['price'] = $_POST['price'];
        $data['dsc']   = $_POST['dsc'];
       $msg = $user->addProduct($data);
       header("Location:../Views/addproduct.php?error=$msg");
     }

     //update product
    if (isset($_POST['update-product'])){
        $data['id']     = $_POST['id'];
        $data['name']   = $_POST['name'];
        $data['dsc']    = $_POST['dsc'];

        if (!$_FILES['img']['error']){

            $data['img']    = $_FILES['img'];
            $data['oldimg'] = $_POST['oldimg'];
        }
        $data['price']  = $_POST['price'];

        $msg = $user->updateProduct($data);

        header("Location:../Views/update_product.php?id={$data['id']}&error=$msg");


    }
    //search for products
    if (isset($_GET['search-product'])){
        $search = $_GET['search-product'];

        $response = array();

        $data = $user->liveSearchProducts($search);

        $i = 0;
        while ($row = $data->fetch_assoc()){

            $response[$i]['name'] = $row['name'];
            $i++;
        }
        $values = array_values($response);
        echo json_encode($values);
        exit();

    }
    //delete Product
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $response['success'] = false;
        if ($user->deleteProduct($id)){
           $response['success'] = true;
        }

        echo json_encode($response);
        exit();
    }
    //Make order
    if (isset($_POST['make-order'])){

        $data['product_id'] = $_POST['product_id'];
        $data['name']       = $_POST['name'];
        $data['phone']      = $_POST['phone'];
        $data['total']      = $_POST['total'];
        $data['address']    = $_POST['address'];
        if ($user->addOreder($data)){
            header("Location: ../Views/make_order.php?id={$data['product_id']}&error=false");
        }else{
            header("Location: ../Views/make_order.php?id={$data['product_id']}&error=true");

        }
    }
    //add question
    if  (isset($_POST['add-question'])){
        $question = htmlspecialchars($_POST['add-question']);
        $response['success'] = false;
        $response['id']      = 0;
        if ($id  = $user->addQuestion($question) ){
            $response['success'] = true;
            $response['id']      = $id;
        }


        echo json_encode($response);
    }
    //add-answer
    if  (isset($_POST['add-answer'])){
        $answer = $_POST['answer'];
        $id     = $_POST['id'];
        $user->addAnswer($id,$answer);
        header("Location:../Views/questions_answers.php");
    }

    if(isset($_POST['search_email'])){
        $response['success'] = false;
        $email = $_POST['search_email'];

        if ($user->searchForUser($email))
            $response['success'] = true;

        echo json_encode($response);
        exit();
    }
    //search another email
    if(isset($_POST['search_another_email'])){

        $response['success'] = false;
        $email    =  $_POST['search_another_email'];
        $oldEmail =  $_POST['old_email'];

        if ($user->searchForAnotherEmail($email,$oldEmail))
              $response['success'] = true;

        echo json_encode($response);
        exit();
    }
    //logout
    if (isset($_GET['logout'])){
        session_destroy();
        header("Location: ../Views/login.php");
    }