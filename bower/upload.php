<?php
error_reporting(0);
session_start();
class Upload
{
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
}
?>
