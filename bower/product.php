<?php
session_start();
class Product
{
  function pUpload($iuid, $iname, $idetail, $iprice,$istatus,$icategory){
     $conn = new Server;
     $on ="on";
     $event = "Product Stored";
     $con = $conn->connect();
     $usave = $con->prepare('INSERT INTO istore(uid,iname,idetail,iprice,event,istatus,icategory) VALUES (?,?,?,?,?,?,?)');
     $usave->bindParam(1, $iuid, PDO::PARAM_INT);
     $usave->bindParam(2, $iname, PDO::PARAM_STR,30);
     $usave->bindParam(3, $idetail, PDO::PARAM_STR,30);
     $usave->bindParam(4, $iprice, PDO::PARAM_INT);
     $usave->bindParam(5, $event, PDO::PARAM_STR,30);
     $usave->bindParam(6, $istatus, PDO::PARAM_STR,5);
     $usave->bindParam(7, $icategory, PDO::PARAM_STR,20);
     //$usave->bind_param('issis',$iuid, $iname,$idetail,$iprice,$event);
     $usave->execute();
     $last_id = $con->lastInsertId();
     //print_r($last_id);
     $update = $con->prepare('INSERT INTO iupdate(updateuid,updateuserid,updateiid,event) VALUES (?,?,?,?)');
     $update->bindParam(1, $iuid, PDO::PARAM_INT);
     $update->bindParam(2, $iuid, PDO::PARAM_INT);
     $update->bindParam(3, $last_id, PDO::PARAM_INT);
     $update->bindParam(4, $event, PDO::PARAM_STR,30);
     //$update->bind_param('iiis',$iuid,$iuid,$last_id,$event);
     $update->execute();
     //echo "New record created successfully. Last inserted ID is: " . $last_id;
     if ($usave && $update) {
        return $last_id;
     } else {
        return 0;
     }
   }
   function pUpdate($updateuid,$piid, $iname, $idetail, $iprice,$istatus,$icategory){
      $time = date("hisa");
      $event = "Product Updated";
      $up= null;
      $conn = new Server;
      $con = $conn->connect();
      $usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=?,event=?,istatus=?,icategory=?,updatedat = null where id=?');
      //$usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
      $usave->bindParam(1, $iname, PDO::PARAM_STR,30);
      $usave->bindParam(2, $idetail, PDO::PARAM_STR,30);
      $usave->bindParam(3, $iprice, PDO::PARAM_INT);
      $usave->bindParam(4, $event, PDO::PARAM_STR,30);
      $usave->bindParam(5, $istatus, PDO::PARAM_STR,5);
      $usave->bindParam(6, $icategory, PDO::PARAM_STR,20);
      $usave->bindParam(7, $piid, PDO::PARAM_INT);
      //$usave->bind_param('ssisi',$iname,$idetail,$iprice,$event,$piid);
      $usave->execute();
      $update = $con->prepare('INSERT INTO iupdate(updateuid,updateuserid,updateiid,event) VALUES (?,?,?,?)');
      $update->bindParam(1, $updateuid, PDO::PARAM_INT);
      $update->bindParam(2, $updateuid, PDO::PARAM_INT);
      $update->bindParam(3, $piid, PDO::PARAM_INT);
      $update->bindParam(4, $event, PDO::PARAM_STR,30);
      //$update->bind_param('iiis',$updateuid,$updateuid,$piid,$event);
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
         $ui->bindParam(1, $iid, PDO::PARAM_INT);
         $ui->bindParam(2, $iimage[$g], PDO::PARAM_STR,30);
         //$ui->bind_param("is",$iid,$iimage[$g]);
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
          $ui->bindParam(1, $iid, PDO::PARAM_INT);
          $ui->bindParam(2, $iimage[$g], PDO::PARAM_STR,30);
          //$ui->bind_param("is",$iid,$iimage[$g]);
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
         $getU->bindParam(1, $uid, PDO::PARAM_INT);
         $getU->bindParam(2, $uid, PDO::PARAM_INT);
         //$getU->bind_param('ii',$uid,$uid);
         $getU->execute();
         $harray = [];
         while ($roow = $getU->fetch(PDO::FETCH_ASSOC)) {
             $harray[] = $roow;
         }
         //print_r($harray);
         return $harray;

       }
       function getsProduct($puid,$piid)
       {
           $conn = new Server;
           $con = $conn->connect();
           $getU = $con->prepare("SELECT istore.*,iimage.pid,iimage.ipic,user.uemail,category.ncategory FROM istore LEFT JOIN iimage ON istore.uid = ? and istore.id = ? and istore.id=iimage.id LEFT JOIN user ON user.uid = istore.uid LEFT JOIN category ON category.cid=istore.icategory order by istore.id = ? desc");
           $getU->bindParam(1, $puid, PDO::PARAM_INT);
           $getU->bindParam(2, $piid, PDO::PARAM_INT);
           $getU->bindParam(3, $piid, PDO::PARAM_INT);
           //$getU->bind_param('iii',$puid,$piid,$piid);
           $getU->execute();
           $harray = [];
           while ($roow = $getU->fetch(PDO::FETCH_ASSOC)) {
               $harray[] = $roow;
           }
           //print_r($harray);
           return $harray;

         }
         function getsoProduct($puid,$piid)
         {
             $conn = new Server;
             $con = $conn->connect();
             $getU = $con->prepare("SELECT istore.*,iimage.pid,iimage.ipic,user.uemail FROM istore INNER JOIN iimage ON istore.uid = ? and istore.istatus='on' and istore.id = ? and istore.id=iimage.id INNER JOIN category ON istore.icategory = category.cid and category.scategory='on' LEFT JOIN user ON user.uid = istore.uid order by istore.id = ? desc");
             $getU->bindParam(1, $puid, PDO::PARAM_INT);
             $getU->bindParam(2, $piid, PDO::PARAM_INT);
             $getU->bindParam(3, $piid, PDO::PARAM_INT);
             //$getU->bind_param('iii',$puid,$piid,$piid);
             $getU->execute();
             $harray = [];
             while ($roow = $getU->fetch(PDO::FETCH_ASSOC)) {
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
       $harray = [];
       while ($roow =  $getU->fetch(PDO::FETCH_ASSOC)) {
           $harray[] = $roow;
       }
       //print_r($harray);
       return $harray;

       }
       function getcProduct()
       {
         $conn = new Server;
         $con = $conn->connect();
         $getU = $con->prepare("SELECT istore.*,iimage.ipic,user.uname,category.* FROM istore INNER JOIN iimage ON istore.istatus='on' and istore.id=iimage.id LEFT JOIN user ON user.uid = istore.uid  INNER JOIN category ON istore.icategory = category.cid and category.scategory='on'  GROUP BY istore.id");
         //$getU->bind_param('i',$uid);
         $getU->execute();
         $harray = [];
         while ($roow =  $getU->fetch(PDO::FETCH_ASSOC)) {
             $harray[] = $roow;
         }
         //print_r($harray);
         return $harray;

         }
         function getcsProduct($cat)
         {
           $conn = new Server;
           $con = $conn->connect();
           $getU = $con->prepare("SELECT istore.*,iimage.ipic,user.uname,category.* FROM istore INNER JOIN iimage ON istore.istatus='on'and istore.icategory=? and istore.id=iimage.id LEFT JOIN user ON user.uid = istore.uid  INNER JOIN category ON istore.icategory = category.cid and category.scategory='on'  GROUP BY istore.id");
           $getU->bindParam(1,$cat,PDO::PARAM_INT);
           $getU->execute();
           $harray = [];
           while ($roow =  $getU->fetch(PDO::FETCH_ASSOC)) {
               $harray[] = $roow;
           }
           //print_r($harray);
           return $harray;

           }
       function pdelete($iid){
          $conn=new Server;
          $con=$conn->connect();
          $st = $con->prepare('DELETE FROM istore WHERE id=?');
          $st->bindParam(1, $iid, PDO::PARAM_INT);
          //$st->bind_param('i', $iid);
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
           $st->bindParam(1, $pid, PDO::PARAM_INT);
           //$st->bind_param('i', $pid);
           $st->execute();
           if($st){
             return true;
           }else{
             return false;
           }
         }
}

?>
