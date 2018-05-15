<?php
session_start();
class Category
{
        function insertCat($icategory){
             $conn = new Server;
             $con = $conn->connect();
             $on ="on";
             $insertC = $con->prepare('INSERT INTO category(ncategory,scategory) VALUES (?,?)');
             $insertC->bindParam(1 ,$icategory, PDO::PARAM_STR,30);
             $insertC->bindParam(2, $on, PDO::PARAM_STR,30);
             $insertC->execute();
             if ($insertC) {
                 return 1;
             } else {
                 return 0;
             }
         }
         function cUpdate($cId,$ncategory,$scategory){
            $conn = new Server;
            $con = $conn->connect();
            $usave = $con->prepare('UPDATE category set ncategory=?,scategory=? where cid=?');
            //$usave = $con->prepare('UPDATE istore set iname=?,idetail=?,iprice=? where id=?');
            $usave->bindParam(1, $ncategory, PDO::PARAM_STR,30);
            $usave->bindParam(2, $scategory, PDO::PARAM_STR,30);
            $usave->bindParam(3, $cId, PDO::PARAM_INT);
            //$usave->bind_param('ssisi',$iname,$idetail,$iprice,$event,$piid);
            $usave->execute();
            if ($usave) {
               return true;
            } else {
               return false;
            }
          }
          function cDelete($dId){
            $conn=new Server;
            $con=$conn->connect();
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
