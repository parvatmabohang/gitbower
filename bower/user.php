<?php
error_reporting(0);
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
        $stmt->bind_param('s', $uemail);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $upw1=$row["upw"];
        $uid=$row['uid'];
        if ($upw1 == $upwn) {
            return $uid;
        } else {
            return 900;
        }

     }
     function getUser($uid)
     {
         $conn = new Server;
         $con = $conn->connect();
         $getU = $con->prepare("SELECT * FROM user where uid=?");
         $getU->bind_param('i',$uid);
         $getU->execute();
         $resultU = $getU->get_result();
         $roow = $resultU->fetch_assoc();
         //$sname=$roow['uname'];
         return $roow;
     }
}
?>
