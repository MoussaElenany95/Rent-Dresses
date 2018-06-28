<?php
require "../Models/DataBase.php";
class UserController extends  DataBase
{

    private $db;

    public function __construct()
    {
        $this->db = $this->connectToDB();
    }

    //login for user
    public function login($username, $password){
        $user = "SELECT * FROM users WHERE  email = '$username'  LIMIT 1";
        $userQuery = mysqli_query($this->db, $user);

        if ($userQuery->num_rows > 0) {

             $data = $userQuery->fetch_assoc();
             if (password_verify($password,$data['password'])){

                 return $data;
             }

        }

        return NULL;
    }

    //sign up
    public function signUp($data)
    {

        $name           = $data['name'];
        $email          = $data['email'];
        $telephone      = $data['telephone'];
        $password       = password_hash($data['password'],PASSWORD_BCRYPT);
        //if user already exist
        if (!$this->searchForUser($email)){

                $assistant    = "INSERT INTO users (name,email,password,phone) VALUES ('$name','$email','$password','$telephone')";
                if (mysqli_query($this->db,$assistant)){
                    return true;
                }

        }

        return false;

    }

    //search for user
    public function searchForUser($email)
    {

        $user  = "SELECT  * FROM users WHERE email = '$email'  LIMIT 1;";

        $query = mysqli_query($this->db,$user);

        if ($query->num_rows > 0){
            return $query->fetch_assoc();
        }

        return NULL;
    }
    //search for another email
    public function searchForAnotherEmail($email,$oldEmail){
        $user  = "SELECT email FROM users WHERE email = '$email' AND email <> '$oldEmail' LIMIT 1;";
        $query = mysqli_query($this->db,$user);

        if ($query->num_rows > 0){
            return true;
        }

        return false;

    }
    //count number of products
    public function countProducts(){

        $count = "SELECT COUNT(id) AS numberOfProducts from product";
        $query = mysqli_query($this->db,$count);

        $numberOfProducts = $query->fetch_assoc();

        return $numberOfProducts['numberOfProducts'];

    }
    //get all products
    public  function getAllProducts($page){
        $products = "SELECT * FROM product ORDER BY uploaded_at DESC LIMIT $page,7 ";
        $query = mysqli_query($this->db,$products);
        return $query;
    }
    //Update user
    public  function updateUser($data){

        $name      = $data['name'];
        $email     = $data['email'];
        $telephone = $data['telephone'];
        $password  = password_hash($data['password'],PASSWORD_BCRYPT);

        if (!$this->searchForAnotherEmail($email,$data['oldemail'])){
            $update = "UPDATE users SET name = '$name' , email = '$email',password = '$password' ,phone = '$telephone'";
            if (mysqli_query($this->db,$update)) {
                return true;
            }
        }


        return false;
    }

    //Add product
    public  function addProduct($data){
        $target_dir = "../uploads/products";
        $target_file = $target_dir.round(microtime(true)) . basename($data['img']['name']);
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if ($FileType != 'jpg' &&  $FileType != 'png'  && $FileType != "jpeg"){
            return "file must be an image";
        }
        //Check file size
        if ($data["img"]["size"] > 3000000) {
            return "Maximum size is 2 MB";
        }
        //upload
        if (move_uploaded_file($data['img']["tmp_name"], $target_file)) {

            $addProduct =  "INSERT INTO product (name,img,price,dsc) VALUES ('{$data['name']}','$target_file','{$data['price']}',{$data['dsc']})";
            mysqli_query($this->db,$addProduct);
            return "Product is added successfully";
        } else {
            return "Error while adding product !";
        }
    }

    //Remove product
    public  function  deleteProduct($id){
        $product = "SELECT * FROM product WHERE id = $id LIMIT 1";

        $query  = mysqli_query($this->db,$product);

        $res    = $query->fetch_assoc() ;

        $deleteProduct = "DELETE FROM product WHERE id = $id";
        $query = mysqli_query($this->db,$deleteProduct);

        if ( $query && mysqli_affected_rows($this->db)){

            if (file_exists($res['img'])) {

                unlink($res['img']);

            }
                return true;
        }

        return false;

    }
    //update product
    public  function updateProduct($data){
        //delete old img
        if ($data['img']){

            if (file_exists($data['oldimg'])){
                unlink($data['oldimg']);
            }

            $target_dir = "../uploads/products/";
            $target_file = $target_dir.round(microtime(true)) . basename($data['img']['name']);
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if ($FileType != 'jpg' &&  $FileType != 'png' && $FileType != "jpeg" ){
                return "file must be an image";
            }

            //Check file size
            if ($data["img"]["size"] > 3000000) {
                return "Maximum size is 2 MB";
            }

            //upload
            if (move_uploaded_file($data['img']["tmp_name"], $target_file)) {

                $addProduct =  "UPDATE product set name = '{$data['name']}',img ='$target_file' ,price ='{$data['price']}', dsc='{$data['dsc']}' WHERE id = {$data['id']}";
                mysqli_query($this->db,$addProduct);
                return "Product is updated successfully";
            } else {
                return "Error while updating product !";
            }
        }

        $addProduct =  "UPDATE product set name = '{$data['name']}',price ='{$data['price']}' ,dsc = '{$data['dsc']}' WHERE id = {$data['id']}";

        mysqli_query($this->db,$addProduct);

        if (mysqli_affected_rows($this->db)){

            return "Product is updated successfully";
        }

        return "No data changed";


    }
    //reject Order
    public  function  rejectOrder($id){

        $order = "DELETE FROM   `order`  WHERE id = $id";
        mysqli_query($this->db,$order);

        if (mysqli_affected_rows($this->db)){
            return true;
        }

        return false;
    }
    //search for product
    public  function searchForProduct($id){
        $product = "SELECT * FROM product WHERE id = $id LIMIT 1";

        $query =  mysqli_query($this->db,$product);

        return $query->fetch_assoc();
    }
    //live search products
    public function liveSearchProducts($search){

        $product = "SELECT name FROM product WHERE LOWER(name) LIKE '%$search%' LIMIT 10";

        $query =  mysqli_query($this->db,$product);

        return $query;
    }
    //search for products
    public  function searchForProducts($search){

        $product = "SELECT * FROM product WHERE LOWER (name) LIKE LOWER ('%$search%')";

        $query =  mysqli_query($this->db,$product);

        return $query;
    }

    //Make Order
    public function addOreder($data){
        $order = "INSERT INTO `order` (`total`, `product_id`, `customer_name`, `customer_phone`, `customer_location`) 
                  VALUES ('{$data['total']}','{$data['product_id']}','{$data['name']}','{$data['phone']}','{$data['address']}')";

        $query = mysqli_query($this->db,$order);

        if ($query)
            return true;
        else
            return false;
    }

    //Get All orders
    public  function getAllOrders(){
        $orders = "SELECT * , product.name As product_name FROM product JOIN  `order` ON order.product_id = product.id ";
        $query  = mysqli_query($this->db,$orders);
        return $query;
    }
    //add question
    public  function  addQuestion($text){
        $question = "INSERT INTO question_answers(question) VALUES ('$text')";

        if (mysqli_query($this->db,$question)){

            return $this->db->insert_id;
        }

        return 0;
    }
    //add answer
    public function addAnswer($id,$answer){
        $answer = "UPDATE question_answers set answer = '$answer' WHERE id = '$id'";

        mysqli_query($this->db,$answer);
    }

    //get All question
    public function  getAllQuestions(){
        $questions = "SELECT * FROM question_answers";
        return mysqli_query($this->db,$questions);
    }

    //delete question
    public function deleteQuestion($id){
        $question = "DELETE FROM question_answers WHERE id = '$id'";
        mysqli_query($this->db,$question);
    }
}