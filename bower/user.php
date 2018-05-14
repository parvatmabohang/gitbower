<?php
//error_reporting(0);
session_start();
require("server.php");
class User
{
    public $uname="";
    public $uemail="";
    public $upw="";
    function loginUser($uemail,$upwn)
    {
        $conn=new Server;
        $con=$conn->connect();
        $stmt = $con->prepare('SELECT * FROM user WHERE uemail = ?');
        //$stmt->bind_param('s', $uemail);
        $stmt->bindParam(1, $uemail, PDO::PARAM_STR,30);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //$result = $stmt->get_result();
        //$row = $result->fetch_assoc();
        $harray = [];
        $upw1=$row["upw"];
        $harray[]=$row['uid'];
        $harray[]=$row['uname'];
        $harray[]=$row['uemail'];
        if ($upw1 == $upwn) {
            return $harray;
        } else {
            return 0;
        }

     }
}
?>
