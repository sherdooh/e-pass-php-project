<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['cpmsaid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['username'];
echo '<script>alert("Login Successfull")</script>';
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!DOCTYPE html>
<html>

<head>
 
    <title>Curfew Pass Management System | Login Page</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <style type="text/css">
          .body-Login-back {
            background-size:cover;
            position:relative;
            z-index:3;
            padding-top:50px;
          }
      </style>

</head>

<body class="body-Login-back" style="background-image: url(images/ceps4.png);
    z-index: -1;
    opacity: .9;">

    <!--================ Header Menu Area start =================-->s
 <?php include_once('includes/header2.php');?>
  <!--================Header Menu Area =================-->


    <div class="container">
       
        <div class="card">
            <div class="col-md-6 col-md-offset-4 text-left logo-margin">
              <h2 style="color: dark;font-size: 3em;">Admin Login;;)<i class="fa fa-briefcase"></i></h2>
                </div>
              <div class="card-body px-lg-5 pt-0">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body" style="background-image: url(../img/admin.jpg) left center no-repeat;background-color: #cce2e2c2">
                        <form role="form" method="post" name="login">
                            <fieldset>
                                <div class="form-group">
                                    <label for="login-username">Username</label>
                                     <input type="text" class="form-control"  required="true" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                                                
                                </div>
                                <div class="form-group">
                                    <label for="login-password">Password</label>
                                    <input type="password" class="form-control" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                                                
                                </div>
                                <div class="checkbox">
                                  
                                        <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
                <label for="keep_me_logged_in">Keep me signed in</label>
                                   

<label style="padding-left: 40px">
    <a href="forgot-password.php">Lost Password?</a></label>
                                </div>

                               
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block" name="login" >
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
