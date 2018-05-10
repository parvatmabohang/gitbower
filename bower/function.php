<?php
require("unity.php");
$uid = $_SESSION['uid'];
$piid=$_GET['p'];
if(isset($_POST['upload'])){
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $isend = $it->isend($uid,$files);
    if ($isend == 789) {
      echo "Unsuccessfull!!!";
    } else {
      $iupload = $pt->pUpload($uid,$iname,$idetail,$iprice);
      if ($iupload == 99) {
        echo "Uploading failed!!!";
      } else {
        //echo "Uploaded!!!";
        $iPic=$pt->pPic($iupload, $isend);
        if ($iPic) {
        header("location:profile.php");
        echo "Successfully Uploaded!!!";
        }
        else {
           echo "Image Not Uploaded!!!";
        }
      }
    }
}
if(isset($_POST['update'])){
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $icheck = strlen($files['name'][0]);
    if($icheck != 0) {
        $isend = $it->isend($uid,$files);
    }
    if ($isend == 789) {
      echo "Unsuccessfull!!!";
    } else {
      $iupload = $pt->pUpdate($piid,$iname,$idetail,$iprice);
      if ($iupload == 99) {
        echo "Uploading failed!!!";
      } else {
        if($icheck != 0){
        $iPic=$pt->picUpdate($piid, $isend);
        if ($iPic) {
        header("location:editProduct.php?p=$piid");
        echo "Successfully Uploaded!!!";
        }
        else {
           echo "Image Not Uploaded!!!";
        }
      } else {
          header("location:editProduct.php?p=$piid");
          echo "Info Updated";
      }
     }
    }

}

?>
