<?php
//error_reporting(0);
session_start();
class Email
{
   function insertReq($reqemail,$resemail,$reqiid)
   {
     $conn = new Server;
     $con = $conn->connect();
     $usave = $con->prepare('INSERT INTO request(requestuid,responseid,reqiid) VALUES (?,?,?)');
     $usave->bindParam(1, $reqemail, PDO::PARAM_STR,30);
     $usave->bindParam(2, $resemail, PDO::PARAM_INT);
     $usave->bindParam(3, $reqiid, PDO::PARAM_INT);
     $usave->execute();
     if ($usave) {
        return true;
     } else {
        return false;
     }
   }
   function getReq($uid)
   {
     $conn = new Server;
     $con = $conn->connect();
     $usave = $con->prepare('SELECT * from request where responseid=? ORDER BY reqid desc');
     $usave->bindParam(1, $uid, PDO::PARAM_INT);
     $usave->execute();
     $harray = [];
     while ($roow =  $usave->fetch(PDO::FETCH_ASSOC)) {
         $harray[] = $roow;
     }
     //print_r($harray);
     return $harray;

   }


}
?>
