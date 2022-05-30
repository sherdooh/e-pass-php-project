<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Curfew e-Pass Management System - Home</title>

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="vendors/rmodal.css">
  

  <link rel="stylesheet" href="css/style.css">
</head>
<body>

 <!--Header-->
 <?php include_once('includes/header.php');?>
  <!--Header-->


   <!--Banner-->
  <section class="hero-banner text-center">
    <div class="container">
      <h1>Curfew e-Pass Management System</h1>
      <a class="button button-outline button-small" href="apply-pass.php">Apply Pass</a>
      <a class="button button-outline button-small" popup-open="popup-1" href="javascript:void(0)">Requirements</a>
      <a class="button button-outline button-small" href="files/add.php">Upload files</a>

<div class="popup" popup-name="popup-1">
  <div class="popup-content black">
  <h2>Services Requring e-Pass</h2>
<p style="color: #343a40;white-space: pre;font-size: bold;">
This e-Pass is ONLY for the essential services providers. Through CePMS<br>(Organization’s Name)will be able to provide essential services to the subjects without any hassle.
1. Police/paramilitary forces which are in Uniform

2. Health services

3. Govt. officials engaged in essential services

4. Caregiver for a Person with Disabilities

5. Other Essential services exempted

</p>
  <a class="close-button" popup-close="popup-1" href="javascript:void(0)">x</a>
  </div>
</div>


<script src="js/jquery.min.js" type="text/javascript"></script>
<script>
$(function() {
  // Open Popup
  $('[popup-open]').on('click', function() {
    var popup_name = $(this).attr('popup-open');
    $('[popup-name="' + popup_name + '"]').fadeIn(300);
  });

  // Close Popup
  $('[popup-close]').on('click', function() {
    var popup_name = $(this).attr('popup-close');
    $('[popup-name="' + popup_name + '"]').fadeOut(300);
  });
  
  // Close Popup When Click Outside
  $('.popup').on('click', function() {
    var popup_name = $(this).find('[popup-close]').attr('popup-close');
    $('[popup-name="' + popup_name + '"]').fadeOut(300);
  }).children().click(function() {
      return false;
    });
  
});
</script>





            </div>
  </section>
  <!--Banner-->


  <!--Search section -->
  <section class="bg-gray domain-search">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-5 col-lg-2 text-center text-md-left mb-3 mb-md-0">
          <h3>Search Your Pass!</h3>
        </div>
        <div class="col-md-7 col-lg-10 pl-2 pl-xl-5">
          <form class="form-inline flex-nowrap form-domainSearch" method="post">
            <div class="form-group">
              <label for="staticDomainSearch" class="sr-only" style="border-radius: 25px;">Search</label>
              <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Enter Your Identity Card Number or Phone number"> 
            </div>
            <button type="submit" class="button rounded-0" name="search" id="submit">Search</button>
          </form>
           <?php
if(isset($_POST['search']))
{ 
$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>

     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
 <?php
$sql="SELECT * from tblpass where IdentityCardno like '$sdata%'|| ContactNumber like '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
      <tr align="center">
<td colspan="6" style="font-size:20px;color:blue">
 Pass ID: <?php  echo ($row->PassNumber);?></td></tr>

  <tr>
    <th scope>Full Name</th>
    <td><?php  echo ($row->FullName);?></td>
    <th scope>Mobile Number</th>
    <td><?php  echo ($row->ContactNumber);?></td>
    <th scope>Email</th>
    <td><?php  echo ($row->Email);?></td>
  </tr>
<tr>
    <th scope>Identity Type</th>
    <td><?php  echo ($row->IdentityType);?></td>
    <th scope>Identity Card Number</th>
    <td><?php  echo ($row->IdentityCardno);?></td>
    <th scope>Category</th>
    <td><?php  echo ($row->Category);?></td>
  </tr>
<tr>
    <th scope>From Date</th>
    <td><?php  echo ($row->FromDate);?></td>
    <th scope>To Date</th>
    <td><?php  echo ($row->ToDate);?></td>
    <th scope>Pass Creation Date</th>
    <td><?php  echo ($row->PasscreationDate);?></td>
  </tr>
                                    
    <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
<?php } }?> 
     </table>

        </div>
      </div>
    </div>
  </section>
  <!--Search section end-->





  <!-- ================ start footer Area ================= -->
   <?php include_once('includes/footer.php');?>
  <!-- ================ End footer Area ================= -->





  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/rmodal.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>