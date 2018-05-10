<?php
require("unity.php");
$uid = $_SESSION['uid'][0];
$uidname = $_SESSION['uid'][1];
$uidemail = $_SESSION['uid'][2];
$ty="";
$ty=$_GET['msg'];
if ($ty == 1) {
echo "Successfully Uploaded!!!";
} elseif($ty == 3||$ty == 2) {
  echo "Unsuccessfull!!!";
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
         <form method="post" action="function.php" enctype="multipart/form-data" id="ushobby" >
           <div class="form-group">
             <label for="text">Item Name:</label>
             <input type="text" class="form-control" name="iname" required>
           </div>
           <div class="form-group">
             <label for="text">Item Detail:</label>
             <textarea type="text" class="form-control" name="idetail" required> </textarea>
           </div>
           <div class="form-group">
             <label for="text">Item Price:</label>
             <input type="number" class="form-control" name="iprice" required>
           </div>
          <div class="form-group">
              <label for="text">Upload Product pic: <i style="color:red;font-size:15px">(You can choose multiple images...)</i></label>
              <input type="file" class="form-control"  name="files[]" id="file" multiple required>
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
       <td><a href="#" onclick="confirmDelete(<?php echo $product[$i]['id']; ?>);" >Delete</a> or  <a href="editProduct.php?p=<?=$product[$i]['id'] ?>" style="text-decoration:none;"> EDIT</a> </form></td>
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
</script>
 <script>
 $(document).ready( function () {
     $('#toop').DataTable();
 });
 </script>
</body>
</html>
