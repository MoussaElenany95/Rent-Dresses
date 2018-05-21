<?php
class DataBase
{
    private  $conn ;
    //Constructor
    public function  __construct()
    {


    }
//connection to database
    protected  function connectToDB(){

        //connect to database
        $dbhost   = "localhost";
        $dbname   = "rent-dresses";
        $username = "root";
        $password  = "";

        $con = mysqli_connect($dbhost,$username,$password,$dbname);
        $con->set_charset("utf8");
        $this->conn = $con;
        return $con;
    }

    //destructor
    public  function  __destruct()
    {

        mysqli_close($this->conn);
    }

}
