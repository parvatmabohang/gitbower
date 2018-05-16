<?php
session_start();
class Category
{
        function insertCat($createdby,$icategory){
             $conn = new Server;
             $con = $conn->connect();
             $on ="on";
             $event = "Category Created";
             $insertC = $con->prepare('INSERT INTO category(createdby,ncategory,scategory) VALUES (?,?,?)');
             $insertC->bindParam(1 ,$createdby, PDO::PARAM_INT);
             $insertC->bindParam(2 ,$icategory, PDO::PARAM_STR,30);
             $insertC->bindParam(3, $on, PDO::PARAM_STR,30);
             $insertC->execute();
             $last_id = $con->lastInsertId();
             $update = $con->prepare('INSERT INTO catupdate(updateuserid,updatecid,event) VALUES (?,?,?)');
             $update->bindParam(1, $createdby, PDO::PARAM_INT);
             $update->bindParam(2, $last_id, PDO::PARAM_INT);
             $update->bindParam(3, $event, PDO::PARAM_STR,30);
             //$update->bind_param('iiis',$iuid,$iuid,$last_id,$event);
             $update->execute();
             if ($insertC && $update) {
                 return 1;
             } else {
                 return 0;
             }
         }
         function cUpdate($cId,$ucid,$ncategory,$scategory){
            $conn = new Server;
            $con = $conn->connect();
            $event = "Category Updated";
            $usave = $con->prepare('UPDATE category set ncategory=?,scategory=? where cid=?');
            //$usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
            $usave->bindParam(1, $ncategory, PDO::PARAM_STR,30);
            $usave->bindParam(2, $scategory, PDO::PARAM_STR,30);
            $usave->bindParam(3, $cId, PDO::PARAM_INT);
            //$usave->bind_param('ssisi',$iname,$idetail,$iprice,$event,$piid);
            $usave->execute();
            $update = $con->prepare('INSERT INTO catupdate(updateuserid,updatecid,event) VALUES (?,?,?)');
            $update->bindParam(1, $ucid, PDO::PARAM_INT);
            $update->bindParam(2, $cId, PDO::PARAM_INT);
            $update->bindParam(3, $event, PDO::PARAM_STR,30);
            //$update->bind_param('iiis',$iuid,$iuid,$last_id,$event);
            $update->execute();
            if ($usave && $update) {
               return true;
            } else {
               return false;
            }
          }
          function cDelete($ucid,$dId){
            $conn=new Server;
            $con=$conn->connect();
            $event = "Category Deleted";
            $stmt = $con->prepare('DELETE from category where cid=?');
            $stmt->bindParam(1, $dId, PDO::PARAM_INT);
            $stmt->execute();
            $istmt = $con->prepare('DELETE from istore where icategory=?');
            $istmt->bindParam(1, $dId, PDO::PARAM_INT);
            $istmt->execute();
            if($stmt && $istmt){
              return true;
            } else {
              return false;
            }
          }
          function categoryInfo(){
            $conn=new Server;
            $con=$conn->connect();
            $stmt = $con->prepare('SELECT * FROM category');
            $stmt->execute();
            $harray = [];
            while ($roow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $harray[] = $roow;
            }
            //print_r($harray);
            return $harray;
          }
          function categorysInfo($cId){
            $conn=new Server;
            $con=$conn->connect();
            $stmt = $con->prepare('SELECT * FROM category where cid=?');
            $stmt->bindParam(1, $cId, PDO::PARAM_INT);
            $stmt->execute();
            $roow = $stmt->fetch(PDO::FETCH_ASSOC);
            //print_r($harray);
            return $roow;
          }
}
?>
