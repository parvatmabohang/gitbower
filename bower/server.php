<?php
class Server
{

    public function connect()
    {
        $servername = "localhost";
        //$hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "store";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        //$conn = mysqli_connect($hostname,$username,$password, $dbname);
        //if ($conn) {
            //return $conn;
        //} else {
            //die("Connection failed: " . mysqli_connect_error());
            //return false;
        //}
    }
}
    //Server::connect();
 ?>
