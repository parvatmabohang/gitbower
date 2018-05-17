<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
$uidemail = $_SESSION['uid'][2];
$piid=$_GET['p'];
$getSellerID="";
$getSellerID=$_GET['getSellerID'];
$ty="";
$ty=$_GET['msg'];
if ($ty == 4) {
echo "Not Uploaded!!!";
} elseif($ty == 1) {
  echo "Record Successfully moved and Updated ";
} elseif ($ty == 2) {
  echo "Info Uploaded  and moved but not image uploaded ";
} elseif($ty == 3) {
  echo "Info Updated but image is empty";
} else { }
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
if(isset($_GET['pId'])){
  $pid=$_GET['pId'];
  $pidelete=$pt->pidelete($pid);
  if($pidelete){echo "Item deleted";}
  else{echo "Unsuccessfull";}
}
//$suser = $rt->getUser($uid);
$product = $pt->getsProduct($getSellerID,$piid);
$b=0;
while ($piid == $product[$b]['id']){$b++;}
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
  <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
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
      </ul>
    </div>
  </nav>  <br>
    <div class="container">
       <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Editproduct</li>
        </ol>
       </nav>
     </div><br>
  <div class="container">
  Name:-  <a href="profile.php" style="color:red;"> <?=$uidname ?></a> <br>
  Email:-  <?=$uidemail ?>
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
        <?php for ($f = 0;$f <=$b-1; $f++ ) {  ?>
          <div class="col-md-5">
            <?php $tcount = strlen($product[0]['ipic']); if($tcount !=0){?>
            <div class="thumbnail">
            <a href="#" onclick="confirmDelete(<?php echo $product[$f]['pid']; ?>,<?= $getSellerID ?>);"> <i class="fa fa-close" style="font-size:10px;padding-left:110px;color:red"></i></a>
             <img  src="<?= $product[$f]['ipic'] ?>"  alt="Lights" style="width:100%"><br>
             </a>
           </div><?php } else { ?>
            <h5> No image..You can upload </h5>
           <?php }?>
         </div>
       <?php } ?>
    </div></div>
  </div>
    <div class="col-sm-8">
      <div class="modal-body">
        <?=$updat ?>
        <form method="post" action="function.php?p=<?=$piid?>&getSellerID=<?= $getSellerID ?>" enctype="multipart/form-data" id="ushobby" >
          <div class="form-group">
            <label for="text">Item Name:</label>
            <input type="text" class="form-control" value="<?= $product[0]['iname']?>" name="iname" required>
          </div>
          <div class="form-group">
            <label for="text">Item Detail:</label>
            <textarea class="form-control" name="idetail" required><?= $product[0]['idetail']?></textarea>
          </div>
          <div class="form-group">
            <label for="text">Item Price:</label>
            <input type="number" class="form-control" value="<?= $product[0]['iprice']?>" name="iprice" required>
          </div>
         <div class="form-group">
             <label for="text">Upload Product pic: <i style="color:red;font-size:15px">(You can choose multiple images...)</i></label>
             <input type="file" class="form-control"  name="files[]" id="file" multiple>
           </div>
           <div class="form-group">
             <label for="text">Product Inactive or Active:</label><br>
              <label class="switch"> <input type="hidden" name="istatus" value="off">
                <?php if($product[0]['istatus'] =="off" ) {  ?> <input type="checkbox" name="istatus">
                 <span class="slider round"></span> <?php } elseif($product[0]['istatus'] =="on") { ?><input type="checkbox" name="istatus" checked>  <span class="slider round"></span> <?php } else{}?>
               </label></div>
               <div class="form-group">
               <label for="sel1">Category(select one):</label>
                 <select class="form-control" id="sel1"  name="icategory">
                   <option><?=$product[0]['ncategory']?></option>
                   <option>None</option>
                   <?php for($ic=0;$ic<$categoryCount;$ic++) { ?>
                    <option value="<?=$categoryInfo[$ic]['cid'] ?>"><?=$categoryInfo[$ic]['ncategory'] ?></option>
                  <?php } ?>
                </select>   </div>
            <button type="submit" class="btn btn-primary" name="update">Submit</button>
         </form>
      </div>
  </div>
  </div>
</div>

<script>
function confirmDelete(pid,gid)
{
   //alert(textMessage);
   var confirmDel = confirm('Are you sure you want to delete');

   if(confirmDel)
   {
      //alert('members.php?delId='+textMessage);
     window.location.href = 'editProduct.php?p=<?=$piid?>&pId='+pid+'&getSellerID=<?= $getSellerID ?>'
   }
}
</script>
</body>
</html>
