<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidemail = $_SESSION['uid'][2];
$idmail = "";
$uidmail="";
$piid = "";
$cat="";
$cat = $_GET['cat'];
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
    $naid = $_POST['naid'];
    $aid1=[];
    $iattribute1=[];
    $iinfo1=[];
    for ($i=0;$i<$naid;$i++) {
      $aid1[$i]=$_POST["aid$i"];
      $iattribute1[$i]=$_POST["iattribute$i"];
      $iinfo1[$i]=$_POST["iinfo$i"];
    }
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $istatus=$_POST['istatus'];
    $icategory=$_POST['icategory'];
    $isend =2;
    $icheck = strlen($files['name'][0]);

    $iupload = $pt->pUpdate($uid,$piid,$iname,$idetail,$iprice,$istatus,$icategory,$aid1,$iattribute1,$iinfo1);
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
    $iuploads = $ct->cUpdate($cId,$uid,$icategory,$catstatus);
    if ($iuploads == true) {
      header("location:categoryEdit.php?cId=$cId&msg=2");
      //echo "Record Unsuccessfull!!!";
    } else {
      header("location:categoryEdit.php?cId=$cId&msg=1");

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
if (isset($_POST['addSpec'])) {
    $iattribute1 = [];
    $iinfo1 = [];
    $pid = $_POST['p'];
    $iattribute = $_POST['iattribute'];
    $iinfo = $_POST['iinfo'];
    $click_count=$_POST['click'];
    for ($j=0;$j<$click_count;$j++) {
       $iattribute1[$j]=$_POST[$j];
       $iinfo1[$j]=$_POST["a$j"];
    }
    $iattribute1[] = $iattribute;
    $iinfo1[] = $iinfo;
    $re=$pt->addSpec($pid,$iattribute1,$iinfo1);
    if ($re) {
        header("location:addspecification.php?p=$pid&msg=1");
    } else {
        header("location:addspecification.php?p=$pid&msg=2");
    }
}
if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] ) {
    //var_dump($_POST);
    $reqemail = $_POST['semail'];
    $reqname = $_POST['sname'];
    $reqcomment = $_POST['scomment'];
    $reqcontact = $_POST['scontact'];
    $reqiid = $_POST['pid'];
    $cat = $_POST['pcat'];
    $ret = $et->insertReq($reqemail,$reqname,$reqcomment,$reqcontact,$reqiid);
    if ($ret) {
        header("location:homeinfo.php?cat=$cat&p=$idmail&q=$uidmail&msg=1");
    } else {
        header("location:homeinfo.php?cat=$cat&p=$idmail&q=$uidmail&msg=2");
    }
    //$arr = json_decode($rsp,TRUE);
}
?>
