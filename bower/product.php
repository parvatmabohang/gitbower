<?php
session_start();
class Product
{
     function getuProduct($uid)
     {
         $conn = new Server;
         $con = $conn->connect();
         $getU = $con->prepare("SELECT istore.*,iimage.ipic FROM istore INNER JOIN iimage ON istore.uid = ? and istore.id=iimage.id GROUP BY istore.id");
         $getU->bind_param('i',$uid);
         $getU->execute();
         $resultU = $getU->get_result();
         $harray = [];
         while ($roow = $resultU->fetch_assoc()) {
             $harray[] = $roow;
         }
         //print_r($harray);
         return $harray;

       }
       function getsProduct($uid,$piid)
       {
           $conn = new Server;
           $con = $conn->connect();
           $getU = $con->prepare("SELECT istore.*,iimage.pid,iimage.ipic FROM istore INNER JOIN iimage ON istore.uid = ? and istore.id = ? and istore.id=iimage.id");
           $getU->bind_param('ii',$uid,$piid);
           $getU->execute();
           $resultU = $getU->get_result();
           $harray = [];
           while ($roow = $resultU->fetch_assoc()) {
               $harray[] = $roow;
           }
           //print_r($harray);
           return $harray;

         }

     function getProduct($uid)
     {
       $conn = new Server;
       $con = $conn->connect();
       $getU = $con->prepare("SELECT istore.*,iimage.ipic FROM istore INNER JOIN iimage ON istore.id=iimage.id GROUP BY istore.id");
       $getU->bind_param('i',$uid);
       $getU->execute();
       $resultU = $getU->get_result();
       $harray = [];
       while ($roow = $resultU->fetch_assoc()) {
           $harray[] = $roow;
       }
       //print_r($harray);
       return $harray;

       }
}

?>
