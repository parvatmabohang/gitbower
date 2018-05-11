<?php
session_start();
class Product
{
  function pUpload($iuid, $iname, $idetail, $iprice){
     $conn = new Server;
     $con = $conn->connect();
     $usave = $con->prepare('INSERT INTO istore(uid,iname,idetail,iprice) VALUES (?,?,?,?)');
     $usave->bind_param('issi',$iuid, $iname,$idetail,$iprice);
     $usave->execute();
     $last_id = $usave->insert_id;
     $update = $con->prepare('INSERT INTO iupdate(updateuid,updateuserid,updateiid) VALUES (?,?,?)');
     $update->bind_param('iii',$iuid,$iuid,$last_id);
     $update->execute();
     //echo "New record created successfully. Last inserted ID is: " . $last_id;
     if ($usave && $update) {
        return $last_id;
     } else {
        return 0;
     }
   }
   function pUpdate($updateuid,$piid, $iname, $idetail, $iprice){
      $time = date("hisa");
      $up= null;
      $conn = new Server;
      $con = $conn->connect();
      $usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
      //$usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
      $usave->bind_param('ssii',$iname,$idetail,$iprice,$piid);
      $usave->execute();
      $update = $con->prepare('UPDATE iupdate set updateuserid=?, updatedat = null where updateiid = ?');
      $update->bind_param('ii',$updateuid,$piid);
      $update->execute();
      //$last_id = $usave->insert_id;
      //echo "New record created successfully. Last inserted ID is: " . $last_id;
      if ($usave && $update) {
         return 1;
      } else {
         return 0;
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

     function getuProduct($uid)
     {
         $conn = new Server;
         $con = $conn->connect();
         $getU = $con->prepare("SELECT istore.*,iimage.ipic FROM istore LEFT JOIN iimage ON istore.uid = ? and istore.id=iimage.id  GROUP BY istore.id ORDER BY istore.uid=? desc");
         $getU->bind_param('ii',$uid,$uid);
         $getU->execute();
         $resultU = $getU->get_result();
         $harray = [];
         while ($roow = $resultU->fetch_assoc()) {
             $harray[] = $roow;
         }
         //print_r($harray);
         return $harray;

       }
       function getsProduct($puid,$piid)
       {
           $conn = new Server;
           $con = $conn->connect();
           $getU = $con->prepare("SELECT istore.*,iimage.pid,iimage.ipic FROM istore LEFT JOIN iimage ON istore.uid = ? and istore.id = ? and istore.id=iimage.id order by istore.id = ? desc");
           $getU->bind_param('iii',$puid,$piid,$piid);
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
       $getU = $con->prepare("SELECT istore.*,iimage.ipic,user.uname FROM istore LEFT JOIN iimage ON istore.id=iimage.id LEFT JOIN user ON user.uid = istore.uid GROUP BY istore.id");
       //$getU->bind_param('i',$uid);
       $getU->execute();
       $resultU = $getU->get_result();
       $harray = [];
       while ($roow = $resultU->fetch_assoc()) {
           $harray[] = $roow;
       }
       //print_r($harray);
       return $harray;

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
