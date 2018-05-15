<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$piid=$_GET['p'];
$pactive="";
$getSellerID=$_GET['getSellerID'];
if(isset($_POST['upload'])){
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $istatus=$_POST['istatus'];
    $icategory=$_POST['icategory'];
    $iupload = $pt->pUpload($uid,$iname,$idetail,$iprice,$istatus,$icategory);
    if ($iupload == 0) {
      header("location:profile.php?msg=4");
    } else {
      $isend = $it->isend($uid,$files);
      if ($isend == 0) {
        header("location:profile.php?msg=1");
        //echo "Info Uploaded but not Image moved  Unsuccessfull!!!";
      } else {
        $iPic=$pt->pPic($iupload, $isend);
        if ($iPic) {
        header("location:profile.php?msg=2");
        //echo "Record Successfully Uploaded!!!";
        }
        else {
            header("location:profile.php?msg=3");
            //echo "Image Not Uploaded!!!";
        }

      }
    }
}
if(isset($_POST['update'])){
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $istatus=$_POST['istatus'];
    $icategory=$_POST['icategory'];
    $isend =2;
    $icheck = strlen($files['name'][0]);

    $iupload = $pt->pUpdate($uid,$piid,$iname,$idetail,$iprice,$istatus,$icategory);
    if($icheck != 0) {
        $isend = $it->isend($uid,$files);
    }
    if ($isend == 0 && $iupload == 0) {
      header("location:editProduct.php?p=$piid&getSellerID= $getSellerID&msg=4");
      //echo "Record Unsuccessfull!!!";
    } else {
      if($icheck != 0){
      $iPic=$pt->picUpdate($piid, $isend);
      if ($iPic) {
      header("location:editProduct.php?p=$piid&getSellerID=$getSellerID&msg=1");
      //echo "Info Successfully moved and  Updated!!!";
      }
      else {
         header("location:editProduct.php?p=$piid&getSellerID=$getSellerID&msg=2");
        // echo "Info Uploaded  and moved but not image uploaded !!!";
      }
    } else {
        header("location:editProduct.php?p=$piid&getSellerID=$getSellerID&msg=3");
        //echo "Info Updated but image is empty";
    }

    }

}

?>
