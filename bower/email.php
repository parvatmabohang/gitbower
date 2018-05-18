<?php
//error_reporting(0);
session_start();
class Email
{
   function insertReq($reqemail,$reqname,$reqcomment,$reqiid)
   {
     $conn = new Server;
     $con = $conn->connect();
     $usave = $con->prepare('INSERT INTO request(requestuid,requestuname,requestucomment,reqiid) VALUES (?,?,?,?)');
     $usave->bindParam(1, $reqemail, PDO::PARAM_STR,30);
     $usave->bindParam(2, $reqname, PDO::PARAM_STR,30);
     $usave->bindParam(3, $reqcomment, PDO::PARAM_STR,30);
     $usave->bindParam(4, $reqiid, PDO::PARAM_INT);
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
     $usave = $con->prepare('SELECT request.*,istore.* from request INNER JOIN istore ON request.reqiid=istore.id and istore.uid = ?  ORDER BY reqid desc LIMIT 4');
     $usave->bindParam(1, $uid, PDO::PARAM_INT);
     $usave->execute();
     $harray = [];
     while ($roow =  $usave->fetch(PDO::FETCH_ASSOC)) {
         $harray[] = $roow;
     }
     //print_r($harray);
     return $harray;

   }
   function getallReq($uid)
   {
     $conn = new Server;
     $con = $conn->connect();
     $usave = $con->prepare('SELECT DISTINCT request.*,istore.*,iimage.* from request INNER JOIN istore ON request.reqiid=istore.id and istore.uid = ? INNER JOIN iimage ON istore.id=iimage.id  ORDER BY reqid desc ');
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
