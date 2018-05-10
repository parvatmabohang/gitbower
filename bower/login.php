<?php
require("unity.php");
if (isset($_POST['login'])) {
    $uemail = $_POST['uemail'];
    $upw = $_POST['upw'];
    $checkrt = $rt->loginUser($uemail,$upw);
    if ($checkrt == 900) {
        echo "Invalid user";
    } else {
        $_SESSION['uid']=$checkrt;
        header("location:dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bower/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src="/bower/bower_components/jquery/distjquery.min.js"></script>
  <script src="/bower/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
          <a class="nav-link" href="#">About Us</a>
        </li>
      </ul>
    </div>
  </nav><br>

<div class="container">
  <h2>Klauzm Store</h2>
  <form method="post" action="login.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="uemail" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upw" required>
    </div>
    <button type="submit" name ="login" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</html>
