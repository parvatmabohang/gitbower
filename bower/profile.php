<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
$uidemail = $_SESSION['uid'][2];
$ty="";
$ty=$_GET['msg'];
//$ty=$_GET['msg'];
if ($ty == 4) {
echo "Record Couldn't Uploaded!!!";
} elseif($ty == 1) {
  echo "Info is Updated but Image couldn't be moved";
} elseif($ty == 2) {
  echo "Record is Uploaded Successfully";
} elseif($ty == 3) {
  echo "Info is Uploaded but not image";
} elseif($ty == 6) {
  echo "Category Created Successfully";
} elseif ($ty == 5) {
   echo "Category creation Unsuccessfull";
} else { }

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:login.php");
}
$product = $pt->getuProduct($uid);
$b=0;
while ($uid == $product[$b]['uid']){$b++;}
if(isset($_GET['delId'])){
  $iid=$_GET['delId'];
  $idelete=$pt->pdelete($iid);
  if($idelete){echo "Item deleted";}
  else{echo "Unsuccessfull";}
}
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
                  <form class="form-inline" ><?php if($categoryInfo[$ic]['scategory']=="on"){?><li style="color:red;"><a href="dashboard.php" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></a> </li><a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px">Edit</a> <?php } else { ?>
                    <li class="disabled" style="color:red;"><?= $categoryInfo[$ic]['ncategory']?></li><a href="categoryEdit.php?cId=<?= $categoryInfo[$ic]['cid'] ?>" style="font-size:10px;">Edit</a><?php } ?></form>

               <?php } ?>
              </ul>
          </div>
        </li>
        <li class="nav-item">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myCat" style="border:0px;background-color:#343140;">
    Create Category<i class="fa fa-plus" style="font-size:18px;color:white"></i>
  </button></li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
     </nav>
   </div>
  <!-- The Modal -->
  <div class="modal fade" id="myCat">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create New Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="function.php?>" enctype="multipart/form-data" id="ushobby" >
            <div class="form-group">
              <label for="text">Category Name:</label>
              <input type="text" class="form-control" name="icategory" placeholder="New Category"required>
            </div>
              <button type="submit" class="btn btn-primary" name="ncat">Submit</button>
           </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <br>
  <div class="container">
  Name:-  <a href="profile.php" style="color:red;"> <?=$uidname ?></a> <br>
  Email:-  <?=$uidemail ?>
  </div><br>
<div class="container">
  <u><h4>Your Product   <t><t>  <i class="fa fa-plus-circle" data-toggle="modal" data-target="#myModal" style="font-size:15px;color:red">Add new product</i></h4></u>

 <!-- The Modal -->
 <div class="modal fade" id="myModal">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Upload Your Product</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>

       <!-- Modal body -->
       <div class="modal-body">
         <form method="post" action="function.php?>" enctype="multipart/form-data" id="ushobby" >
           <div class="form-group">
             <label for="text">Item Name:</label>
             <input type="text" class="form-control" name="iname" required>
           </div>
           <div class="form-group">
             <label for="text">Item Detail:</label>
             <textarea  type="text" class="form-control" placeholder="Product Description"  name="idetail" required></textarea>
           </div>
           <div class="form-group">
             <label for="text">Item Price:</label>
             <input type="number" class="form-control" name="iprice" required>
           </div>
          <div class="form-group">
              <label for="text">Upload Product pic: <i style="color:red;font-size:15px">(You can choose multiple images...)</i></label>
              <input type="file" class="form-control"  name="files[]" id="file" multiple required>
            </div>
            <div class="form-group">
              <label for="text">Product Inactive or Active:</label><br>
               <label class="switch"> <input type="hidden" name="istatus" value="off">
                  <input type="checkbox" name="istatus">
                  <span class="slider round"></span>
                </label></div>
                     <div class="form-group">
                       <label for="text">Select category:</label>
                       <select class="form-control" id="sel1" name="icategory">
                         <option>None</option>
                         <?php for($ic=0;$ic<$categoryCount;$ic++) { ?>
                          <option value="<?=$categoryInfo[$ic]['cid'] ?>"><?=$categoryInfo[$ic]['ncategory'] ?></option>
                        <?php } ?>
                      </select>
                     </div>
             <button type="submit" class="btn btn-primary" name="upload">Submit</button>
          </form>
       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>

     </div>
   </div>
 </div>
  <!-- Table -->
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
        for ($i=0;$i<=$b-1;$i++) { ?>
     <tr>
       <td><?= $product[$i]['id']?></td>
       <td><img src="<?= $product[$i]['ipic'] ?>" height="92" width="92">
       <div style="margin-top:10px;">By: <a href="#" style="color:blue;"> <?=$uidname?></a></div></td>
       <td><?= $product[$i]['iname']?></td>
       <td><?= $product[$i]['idetail']?></td>
       <td><?= $product[$i]['iprice']?></td>
       <td><a href="#" onclick="confirmDelete(<?php echo $product[$i]['id']; ?>);" >Delete</a> or  <a href="editProduct.php?p=<?=$product[$i]['id'] ?>&getSellerID=<?= $product[$i]['uid'] ?>" style="text-decoration:none;"> EDIT</a> </form>
        <br><br><a href="addspecification.php?p=<?=$product[$i]['id'] ?>" style="text-decoration:none;"> Add Product Specifications </a>
       </td>
     </tr>
     <?php } ?>
   </tbody>

 </table>
</div>

<script>
function confirmDelete(textMessage)
{
   //alert(textMessage);
   var confirmDel = confirm('Are you sure you want to delete');

   if(confirmDel)
   {
      //alert('members.php?delId='+textMessage);
     window.location.href = 'profile.php?delId='+textMessage
   }
}
function scategory(opt,cat)
{

     window.location.href = 'profile.php?oId='+opt+'&cId='+cat

}
function dcategory(cat)
{

     window.location.href = 'profile.php?dId='+cat

}
</script>
 <script>
 $(document).ready( function () {
     $('#toop').DataTable();
 });
 </script>
</body>
</html>
