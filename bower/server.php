<?php
class Server
{
    public function connect()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "store";
        $conn = mysqli_connect($hostname,$username,$password, $dbname);
        if ($conn) {
            return $conn;
        } else {
            die("Connection failed: " . mysqli_connect_error());
            return false;
        }
    }
}
 ?>
