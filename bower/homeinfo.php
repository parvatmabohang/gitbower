<?php
require("unity.php");
$piid=$_GET['p'];
$puid=$_GET['q'];
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
$ty="";
$ty = $_GET['msg'];
if ($ty == 2) {
  echo "Not Posted";
} elseif($ty == 1) {
  echo "Request is Posted";
} elseif($ty == 3) {
  echo "Not Verified";
} else {
}
$product = $pt->getsoProduct($puid,$piid);
$b=0;
while ($piid == $product[$b]['id']){$b++;}
?>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bower/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
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
    <a class="navbar-brand" href="home.php"><h4>Klauzm Store</h4></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
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
       <li class="breadcrumb-item"><a href="login.php">Login</a></li>
       <li class="breadcrumb-item"><a href="home.php">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Homeinfo</li>
      </ol>
     </nav>
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
            <button type="submit" class="btn btn-primary" name="sendmail">Buy</button></form>
      </div>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Send Request:-</h4>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post" action="function.php?idmail=<?= $product[0]['id'] ?>&uidmail=<?= $product[0]['uid'] ?>" id="ushobby" >
              <div class="form-group">
                <label for="text">Email:</label>
                <input placeholder="Enter Email" type="text" class="form-control" name="semail" required>
              </div>
              <input type="hidden" value="<?= $product[0]['id'] ?>" name="pid">
              <div class="g-recaptcha" data-sitekey="6LcYg1kUAAAAAGAsJqOx3UXogIjk4mWYaCyZg5XK"></div>
               <br>
                <button type="submit" class="btn btn-primary" name="sendM">Submit</button>
             </form>

          </div>

        </div>
      </div>
  </div>
  </div>
</div>

</body>
</html>
