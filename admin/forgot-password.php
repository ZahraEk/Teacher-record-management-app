<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('رمز عبور با موفقیت تغییر یافت');</script>";
}
else {
echo "<script>alert(' فرمت شماره همراه و یا ایمیل اشتباه می باشد');</script>"; 
}
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    
    <title>فراموشی رمز عبور</title>
  

    <link rel="apple-touch-icon" href="apple-icon.png">
   


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("مقادیر وارد شده هم خوانی ندارند");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>

<body class="bg-dark" style=" background-image: url('images/home-banner.jpg');">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                      <h3 style="color:black"> سیستم مدیریت سوابق اساتید </h3>
                    <hr  color="red"/>
                </div>
                <div class="login-form">
                    <form action="" method="post" name="chngpwd" onSubmit="return valid();">
                        
<div class="form-group">
<label>ایمیل</label>
<input type="email" class="form-control"  required="" name="email">
</div>

<div class="form-group">
<label>شماره همراه</label>
<input type="text" class="form-control"  name="mobile" required="true">
</div>
                        
<div class="form-group">
<label>رمز عبور</label>
<input class="form-control" type="password" name="newpassword" required="true"/>
</div>

<div class="form-group">
<label>تکرار رمز عبور</label>
<input class="form-control" type="password" name="confirmpassword" required="true" />
</div>

<div class="checkbox">
<label class="pull-left">
 <a href="index.php">تایید</a>
 </label>
</div>

<button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" name="submit">بازنشانی</button>
</form>

</div>
</div>
</div>
</div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
