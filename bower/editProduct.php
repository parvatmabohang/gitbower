<?php
require("all.php");
$uid = $_SESSION['uid'];
$piid=$_GET['p'];
$rt = new User;
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
if(isset($_GET['pId'])){
  $pid=$_GET['pId'];
  $pidelete=$rt->pidelete($pid);
  if($pidelete){echo "Item deleted";}
  else{echo "Unsuccessfull";}
}
$suser = $rt->getUser($uid);
$product = $rt->getsProduct($uid,$piid);
$icount=count($product);
if(isset($_POST['update'])){
    $iname = $_POST['iname'];
    $idetail = $_POST['idetail'];
    $iprice = $_POST['iprice'];
    $files = $_FILES['files'];
    $ifile = [];
    //print_r($files['name']);
    //echo count($files['name']);
    $icheck = strlen($files['name'][0]);
    if($icheck != 0) {
    foreach ($files['name'] as $position => $file_name) {
        $file_tmp = $files['tmp_name'][$position];
        $file_name = $files['name'][$position];
        $file_size =$files['size'][$position];
        $expensions= array("jpeg","jpg","png");
        $ifile[] = "image/$uid".$file_name;
        $file_ext=strtolower(end(explode('.',$files['name'][$position])));
        if (in_array($file_ext,$expensions) === true) {
            //echo "OK";
            move_uploaded_file($file_tmp,"image/$uid".$file_name);
        } else {
            echo "extension not allowed, please choose a PDF or JPEG or PNG file.";
        }
     }
    }
    $iupload = $rt->pUpdate($piid,$iname,$idetail,$iprice);
    if ($iupload == 99) {
      echo "Uploading failed!!!";
    } else {
      if($icheck != 0){
      $iPic=$rt->picUpdate($piid, $ifile);
      if ($iPic) {
      echo "Successfully Updated!!!";
      }
      else {
         echo "Image Not Uploaded!!!";
      }
    }else {
      echo "Info Updated";
    }

}
}
?>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bower/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src="/bower/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/bower/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="dashboard.php"><h4>Klauzm Store</h4></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="profile.php" class="btn btn-info btn-lg" style="border:0px;background-color:#343140;">
              <i class="fa fa-user" style="color:white"></i>
            </a>
        </li>
        <li class="nav-item">
          <form class="container"method="post" action="dashboard.php">
          <button class="btn btn-default btn-sm" value="Logout" name="logout">Logout<i class="fa fa-sign-out"></i></button>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
      </ul>
    </div>
  </nav><br>
  <div class="container">
  Name:-  <a href="profile.php" style="color:red;"> <?=$suser['uname']; ?></a> <br>
  Email:-  <?=$suser['uemail']; ?>
  </div><br>
<div class="container">
  <u><h4>Edit Your Product  <span style="font-size:15px;">(Product ID:- <i style="color:red;font-size:15px;"><?= $product[0]['id'] ?></i>) </span></h4></u>


</div>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <p>Item Images:</p>
      <div class="container">
        <div class="row">
        <?php for ($f = 0;$f <=$icount-1; $f++ ) {  ?>
          <div class="col-md-5">
            <div class="thumbnail">
            <a href="#" onclick="confirmDelete(<?php echo $product[$f]['pid']; ?>);"> <i class="fa fa-close" style="font-size:10px;padding-left:110px;color:red"></i></a>
             <img  src="<?= $product[$f]['ipic'] ?>"  alt="Lights" style="width:100%"><br>
             </a>
            </div>
         </div>
       <?php } ?>
    </div></div></div>
    <div class="col-sm-8">
      <div class="modal-body">
        <form method="post" action="editProduct.php?p=<?=$piid?>" enctype="multipart/form-data" id="ushobby" >
          <div class="form-group">
            <label for="text">Item Name:</label>
            <input type="text" class="form-control" value="<?= $product[0]['iname']?>" name="iname" required>
          </div>
          <div class="form-group">
            <label for="text">Item Detail:</label>
            <textarea type="text" class="form-control" name="idetail" required> <?= $product[0]['idetail']?></textarea>
          </div>
          <div class="form-group">
            <label for="text">Item Price:</label>
            <input type="number" class="form-control" value="<?= $product[0]['iprice']?>" name="iprice" required>
          </div>
         <div class="form-group">
             <label for="text">Upload Product pic: <i style="color:red;font-size:15px">(You can choose multiple images...)</i></label>
             <input type="file" class="form-control"  name="files[]" id="file" multiple>
           </div>
            <button type="submit" class="btn btn-primary" name="update">Submit</button>
         </form>
      </div>
  </div>
  </div>
</div>

<script>
function confirmDelete(pid)
{
   //alert(textMessage);
   var confirmDel = confirm('Are you sure you want to delete');

   if(confirmDel)
   {
      //alert('members.php?delId='+textMessage);
     window.location.href = 'editProduct.php?p=<?=$piid?>&pId='+pid
   }
}
</script>
</body>
</html>
