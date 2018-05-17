<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
$product = $pt->getProduct($uid);
$icount=count($product);
if(isset($_GET['oId'])&&isset($_GET['cId'])){
$oId=$_GET['oId'];
$cId=$_GET['cId'];
$dId=$pt->cUpdate($cId,$oId);
}
if(isset($_GET['dId'])){
$dId=$_GET['dId'];
$dId=$pt->cDelete($dId);
if($dId){
  echo "Category Deleted";
} else {
  echo "Unsuccessfull";
}
}
$getReq=$et->getReq($uid);
$countgetReq=count($getReq);
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
        <li class="nav-item">
          <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="border:0px;background-color:#343140;color:white;">Category
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="border:0px;">
                  <li><a href="dashboard.php" style="color:red;">All</a></li>
                  <?php for($ic=0;$ic<$categoryCount;$ic++) { ?>
                  <form class="form-inline" ><?php if($categoryInfo[$ic]['scategory']=="on"){?><li style="color:red;"><a href="dashboard.php" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></a> </li><a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px;">Edit</a><?php } else {?>
                    <li class="disabled" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></li><a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px;">Edit</a>
                   <?php } ?></form>

               <?php } ?>
              </ul>
          </div>
        </li>
        <li class="nav-item">
        <div class="btn-group">
           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border:0px;color:white;">Requests
           </button>
           <div class="dropdown-menu">
             <?php for ($i = 0;$i<$countgetReq;$i++) { ?>
              <a class="dropdown-item" href="#"><span style="color:red;"><?=$getReq[$i]['requestuid'] ?></span> requested you for product <span style="color:red;"><?=$getReq[$i]['reqiid'] ?></span></a>
              <div class="dropdown-divider"></div>
            <?php } ?>
           </div>
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
       <td><a href="info.php?p=<?=$product[$i]['id']?>&q=<?=$product[$i]['uid']?>  ">Want to buy</a> or <a href="editProduct.php?p=<?=$product[$i]['id'] ?>&getSellerID=<?= $product[$i]['uid'] ?>" style="text-decoration:none;"> EDIT</a></td>
     </tr>
     <?php } ?>
   </tbody>
 </table>
</div>
<script>
function scategory(opt,cat)
{

     window.location.href = 'dashboard.php?oId='+opt+'&cId='+cat

}
function dcategory(cat)
{

     window.location.href = 'dashboard.php?dId='+cat

}
</script>
 <script>
 $(document).ready( function () {
     $('#toop').DataTable();
 });
 </script>
</body>
</html>
