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
      function pUpload($iuid, $iname, $idetail, $iprice){
         $conn = new Server;
         $con = $conn->connect();
         $usave = $con->prepare('INSERT INTO istore(uid,iname,idetail,iprice) VALUES (?,?,?,?)');
         $usave->bind_param('issi',$iuid, $iname,$idetail,$iprice);
         $usave->execute();
         $last_id = $usave->insert_id;
         //echo "New record created successfully. Last inserted ID is: " . $last_id;
         if ($usave) {
            return $last_id;
         } else {
            return 99;
         }
       }
       function pUpdate($piid, $iname, $idetail, $iprice){
          $conn = new Server;
          $con = $conn->connect();
          $usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
          $usave->bind_param('ssii',$iname,$idetail,$iprice,$piid);
          $usave->execute();
          //$last_id = $usave->insert_id;
          //echo "New record created successfully. Last inserted ID is: " . $last_id;
          if ($usave) {
             return $last_id;
          } else {
             return 99;
          }
        }
       function pPic($iid, $iimage){
          $conn = new Server;
          $con = $conn->connect();
          $ifile=count($iimage);
          //echo $ifile."haha";
          $ui = $con->prepare("INSERT INTO iimage(id,ipic) VALUES (?,?)");
          for ($g = 0; $g <= $ifile-1;$g++)
          {
             $ui->bind_param("is",$iid,$iimage[$g]);
             //echo $iimage[$g];
             $ui->execute();
          }
          if ($ui) {
             return true;
          } else {
             return false;
          }
        }
        function picUpdate($iid, $iimage){
           $conn = new Server;
           $con = $conn->connect();
           $ifile=count($iimage);
           //echo $ifile."haha";
           $ui = $con->prepare("INSERT INTO iimage(id,ipic) VALUES (?,?)");
           for ($g = 0; $g <= $ifile-1;$g++)
           {
              $ui->bind_param("is",$iid,$iimage[$g]);
              //echo $iimage[$g];
              $ui->execute();
           }
           if ($ui) {
              return true;
           } else {
              return false;
           }
         }
       function pdelete($iid){
          $conn=new Server;
          $con=$conn->connect();
          $st = $con->prepare('DELETE FROM istore WHERE id=?');
          $st->bind_param('i', $iid);
          $st->execute();
          if($st){
            return true;
          }else{
            return false;
          }
        }
        function pidelete($pid){
           $conn=new Server;
           $con=$conn->connect();
           $st = $con->prepare('DELETE FROM iimage WHERE pid=?');
           $st->bind_param('i', $pid);
           $st->execute();
           if($st){
             return true;
           }else{
             return false;
           }
         }

}
?>
