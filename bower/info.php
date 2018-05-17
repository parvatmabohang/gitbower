<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
$uidemail = $_SESSION['uid'][2];
$piid=$_GET['p'];
$puid=$_GET['q'];
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
$ty="";
$ty = $_GET['msg'];
if ($ty == 2) {
  echo "Mail not sent";
} elseif($ty == 1) {
  echo "Mail sent";
} else { }
$product = $pt->getsProduct($puid,$piid);
$b=0;
while ($piid == $product[$b]['id']){$b++;}
?>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bower/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src="/bower/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/bower/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
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
  </nav>
  <br>
  <div class="container">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Info</li>
      </ol>
     </nav>
   </div><br>
  <div class="container">
  Name:-  <a href="profile.php" style="color:red;"> <?=$uidname ?></a> <br>
  Email:-  <?=$uidemail ?>
  </div><br>
<div class="container">
  <u><h5>Product Details  <span style="font-size:15px;">(Product ID:- <i style="color:red;font-size:15px;"><?= $product[0]['id'] ?></i>) </span></h5></u>


</div>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <p>Item Images:</p>
            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
        <?php for ($f = 0;$f <=$b-1; $f++ ) {  ?><?php $iexplode=explode("/",$product[$f]['ipic']);$iexp=$iexplode[0]."/600".$iexplode[1];?>
              <?php $tcount = strlen($product[0]['ipic']); if($tcount !=0){?>  <img  src="<?= $iexp?>"> <?php } else { ?><h5> No images... </h5> <? }?>
             </a>
       <?php } ?>
     </div>


  </div>
    <div class="col-sm-8">
      <div class="modal-body">

          <div class="form-group">
            <label for="text">Item Name:-<i style="color:red;"></label> <?= $product[0]['iname']?></i>
          </div>
          <div class="form-group">
            <label for="text">Item Detail:-</label><i style="color:red;"><?= $product[0]['idetail']?></i>
          </div>
          <div class="form-group">
            <label for="text">Item Price:-</label><i style="color:red;"><?= $product[0]['iprice']?></i>
          </div>
        <form method="post" action="function.php?idmail=<?= $product[0]['id'] ?>&uidmail=<?= $product[0]['uid'] ?>" enctype="multipart/form-data" id="ushobby" >
            <input type="hidden" value="<?= $product[0]['id'] ?>" name="pid">
            <input type="hidden" value="<?= $product[0]['iname'] ?>" name="pname">
            <input type="hidden" value="<?= $product[0]['idetail'] ?>" name="pdetail">
            <input type="hidden" value="<?= $product[0]['iprice'] ?>" name="pprice">
            <input type="hidden" value="<?= $product[0]['uemail'] ?>" name="pemail">
            <button type="submit" class="btn btn-primary" name="sendmail">Buy</button>
         </form>
      </div>
  </div>
  </div>
</div>

</body>
</html>
