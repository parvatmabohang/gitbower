<?php
require("unity.php");
$uid = $_SESSION['uid'];
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
$suser = $rt->getUser($uid);
$product = $pt->getProduct($uid);
$icount=count($product);
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
<table id="toop" class="table table-bordered">
   <thead>
     <tr>
       <th>Item ID</th>
       <th>ItemImage</th>
       <th>Item Name</th>
       <th>Item Detail</th>
       <th>Item Price</th>
        <th>Action</th>
    </tr>
   </thead>
   <tbody>
     <?php
        for ($i = 0;$i<$icount;$i++) { ?>
     <tr>
       <td><?= $product[$i]['id']?></td>
       <td><img src="<?= $product[$i]['ipic'] ?>" height="92" width="92">
      <?php
           $getSeller=$rt->getUser($product[$i]['uid']);
        ?><div style="margin-top:10px;">By: <a href="#" style="color:blue;"> <?= $getSeller['uname'] ?></a></div></td>
       <td><?= $product[$i]['iname']?></td>
       <td><?= $product[$i]['idetail']?></td>
       <td><?= $product[$i]['iprice']?></td>
       <td><a href="info.php?p=<?=$product[$i]['id']?>">Want to buy</a></td>
     </tr>
     <?php } ?>
   </tbody>
 </table>
</div>
 <script>
 $(document).ready( function () {
     $('#toop').DataTable();
 });
 </script>
</body>
</html>
