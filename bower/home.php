<?php
require("unity.php");
$product = $pt->getcProduct();
$icount=count($product);
$categoryInfo=$ct->categoryInfo();
$categoryCount=count($categoryInfo);
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
  <style>
  .disabled {
      pointer-events:none;
      opacity:0.5;
  }
  </style>
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
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="border:0px;background-color:#343140;color:white;">Category
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="border:0px;">
                  <li><a href="home.php" style="color:red;">All</a></li>
                  <?php for($ic=0;$ic<$categoryCount;$ic++) { ?>
                  <?php if($categoryInfo[$ic]['scategory']=="on"){?><li><a href="category.php?cat=<?= $categoryInfo[$ic]['cid']?>" style="color:red;"><?=$categoryInfo[$ic]['ncategory']?> </a></li> <?php } else {?><li class="disabled"><a href="#" style="color:red;"><?=$categoryInfo[$ic]['ncategory']?></a> </li><?php } ?>
                 <?php } ?>
              </ul>
          </div>
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
       <div style="margin-top:10px;">By: <a href="#" style="color:blue;"> <?= $product[$i]['uname'] ?></a></div></td>
       <td><?= $product[$i]['iname']?></td>
       <td><?= $product[$i]['idetail']?></td>
       <td><?= $product[$i]['iprice']?></td>
       <td><a href="homeinfo.php?p=<?=$product[$i]['id']?>&q=<?=$product[$i]['uid']?>  ">Want to buy</a></td>
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
