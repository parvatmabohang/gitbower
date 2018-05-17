<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidemail = $_SESSION['uid'][2];
$idmail = "";
$uidmail="";
$piid = "";
$idmail=$_GET['idmail'];
$uidmail = $_GET['uidmail'];
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
if(isset($_POST['ncat'])){
    $icategory = $_POST['icategory'];
    $iupload = $ct->insertCat($uid,$icategory);
    if ($iupload == 0) {
      header("location:profile.php?msg=5");
      //echo "Record Unsuccessfull!!!";
    } else {
      header("location:profile.php?msg=6");

    }

}
if(isset($_POST['editCat'])){
    $icategory = $_POST['icategory'];
    $catstatus = $_POST['istatus'];
    $cId = $_POST['cId'];
    $iupload = $ct->cUpdate($cId,$uid,$icategory,$catstatus);
    if ($iupload) {
      header("location:categoryEdit.php?cId=$cId&msg=2");
      //echo "Record Unsuccessfull!!!";
    } else {
      header("location:categoryInfo.php?cId=$cId&msg=1");

    }

}
if (isset($_POST['sendmail'])) {
    $pid = $_POST['pid'];
    $pemail = $_POST['pemail'];
    $re=$ret->call($uidemail,$pemail,$pid);
    if ($re) {
        header("location:info.php?p=$idmail&q=$uidmail&msg=1");
    } else {
        header("location:info.php?p=$idmail&q=$uidmail&msg=2");
    }
}
if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] ) {
    //var_dump($_POST);
    $reqemail = $_POST['semail'];
    $rese = $_POST['ssemail'];
    $reqiid = $_POST['pid'];
    $ret = $et->insertReq($reqemail,$rese,$reqiid);
    if ($ret) {
        header("location:homeinfo.php?p=$idmail&q=$uidmail&msg=1");
    } else {
        header("location:homeinfo.php?p=$idmail&q=$uidmail&msg=2");
    }
    //$arr = json_decode($rsp,TRUE);
} else {
        header("location:homeinfo.php?p=$idmail&q=$uidmail&msg=3");
}
?>
