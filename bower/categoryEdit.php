<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
$uidemail = $_SESSION['uid'][2];
if(isset($_GET['dId'])){
$dId=$_GET['dId'];
$dId=$ct->cDelete($uid,$dId);
if($dId){
  echo "Category Deleted";
} else {
  echo "Unsuccessfull";
}
}
$cId = $_GET['cId'];
if($_GET['msg']==2) {
  echo "Category Updated";
} elseif($_GET['msg']==1) {
  echo "Unsuccessfull";
} else { }
$categoryInfo=$ct->categoryInfo();
$categoryCount=count($categoryInfo);
$categorysInfo=$ct->categorysInfo($cId);
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
  .switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
}

.switch input {display:none;}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}
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
                  <form class="form-inline" ><?php if($categoryInfo[$ic]['scategory']=="on"){?><li style="color:red;"><a href="dashboard.php" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></a> </li><a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px">Edit</a>  <?php } else {?>
                    <li class="disabled" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></li> <a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px">Edit</a><?php } ?></form>

               <?php } ?>
              </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav><br>
  <div class="container">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Categoryedit</li>
      </ol>
     </nav>
   </div>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Upate Product Category:-</h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="function.php?cId=<?=$cId?>" enctype="multipart/form-data" id="ushobby" >
            <div class="form-group">
              <label for="text">New Category Name:</label>
              <input type="text" class="form-control" name="icategory" value="<?=$categorysInfo['ncategory']?>" required>
            </div><input type="hidden" name="cId" value="<?=$categorysInfo['cid']?>">
            <div class="form-group">
              <label for="text">Category Active or Inactive:</label><br>
               <label class="switch"> <input type="hidden" name="istatus" value="off">
                 <?php if($categorysInfo['scategory'] =="off" ) {  ?> <input type="checkbox" name="istatus">
                  <span class="slider round"></span> <?php } elseif($categorysInfo['scategory'] =="on") { ?><input type="checkbox" name="istatus" checked>  <span class="slider round"></span> <?php } else{}?>
                </label></div>
              <button type="submit" class="btn btn-primary" name="editCat">Submit</button>
           </form>
           <hr>
             <button type="submit" class="btn btn-primary"  onclick="dcategory('<?=$categorysInfo['cid']?>','<?= $categorysInfo['cid']?>')" name="deleteCat">Delete Category</button>
        </div>

      </div>
    </div>
    <script>
    function dcategory(icat,cat)
    {

         window.location.href = 'categoryEdit.php?dId='+icat+'&cId='+cat

    }
    </script>
</body>
</html>
