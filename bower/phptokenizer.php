<?php
if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] ) {
    var_dump($_POST);
    //$arr = json_decode($rsp,TRUE);
}?>
<!DOCTYPE html>
<html>
<body>
<br>
<?php
$str = "Hello world. It's a beautiful day.";
$strr=explode(" ",$str);
echo $strr[0];
print_r (explode(" ",$str));
?>

</body>
</html>
