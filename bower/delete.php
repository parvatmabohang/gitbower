<?php
session_start();
class DELETE
{
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
