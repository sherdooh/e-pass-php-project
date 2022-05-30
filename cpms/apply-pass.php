<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

    if(isset($_POST['submit']))
  {

$fname=$_POST['fullname'];
$cnum=$_POST['cnumber'];
$email=$_POST['email'];
$itype=$_POST['identitytype'];
$icnum=$_POST['icnum'];
$cat=$_POST['category'];
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$ainfo=$_POST['info'];






$sql="insert into tblapplypass(FullName,ContactNumber,Email,IdentityType,IdentityCardno,Category,FromDate,ToDate,Information)
values(:fname,:cnum,:email,:itype,:icnum,:cat,:fdate,:tdate,:ainfo)";
$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':cnum',$cnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':itype',$itype,PDO::PARAM_STR);
$query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
$query->bindParam(':cat',$cat,PDO::PARAM_STR);
$query->bindParam(':fdate',$fdate,PDO::PARAM_STR);
$query->bindParam(':tdate',$tdate,PDO::PARAM_STR);
$query->bindParam(':ainfo',$ainfo,PDO::PARAM_STR);



 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Application successful.")</script>';
echo "<script>window.location.href ='apply-pass.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }  

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Curfew e-Pass Management System - apply</title>

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>


<body>
 <!--  -->
    <section class="hero-banner2 text-left">
    <div class="container">
      <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                
                <!--end page header -->
            </div>



            <div class="row pace-theme-big-counter">
                <div class="col-lg-6">
                    <!-- Form Elements -->
                    <div class="panel panel-default" style="color: #000;font-weight:bold">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                
                                    <form method="post" enctype="multipart/form-data" > 
       <div class="form-row align-items-left">               
     <label for="exampleInputEmail1">Full Name</label> <input type="text" name="fullname" value="" class="form-control" required='true'>
    <label for="exampleInputEmail1">Contact Number</label> <input type="text" name="cnumber" value="" class="form-control" id='phone' required='true' minlength="10" maxlength="12" pattern="[0-9]+">
    <label for="exampleInputEmail1">Email Address</label> <input type="email" name="email" value="" class="form-control" id='email' required='true'>


    <div class="form-group"> <label for="exampleInputEmail1">Identity Type</label><select type="text" name="identitytype" value="" class="form-control" required='true'>
<option value="">Choose Identity Type</option>
<option value="Voter Card">Voter Card</option>
<option value="Identity Card">Identity Card</option>
<option value="Employee Card">Employee Card</option>
<option value="Student Card">Student Card</option>
<option value="Driving License">Driving License</option>
<option value="Passport">Passport</option>
<option value="Any Other Official Card">Any Other Official Card</option>
<option value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
     </select></div>
    <div class="form-group"> <label for="exampleInputEmail1">Identity/Student Card No.</label> <input type="text" name="icnum" minlength="8" maxlength="10" value="" id='cardno' class="form-control" required='true'> </div>
     <div class="form-group"> <label for="exampleInputEmail1">Category</label><select type="text" name="category" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php } ?>
     </select></div>
<div class="form-group"> <label for="exampleInputEmail1">From Date</label> <input type="date" name="fromdate" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">To Date</label> <input type="date" name="todate" value="" class="form-control" required='true'> </div>

</div>
<div class="form-group">
<label for="exampleInputEmail1">Additional Info</label>
  <textarea name="info" cols="35" rows="2" class="form-control"></textarea>
</div>


     <div style="padding-left: 450px;"><button type="submit" class="btn btn-primary" name="submit" id="submit">Apply</button>
     </div>
    

     </form>



                   </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
    
<script>
  var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
<?php
include_once "footer.php";
?>
    
      


            </div>
  </section>

        
        
    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
