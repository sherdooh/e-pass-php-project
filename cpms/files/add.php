<?php

session_start();
error_reporting(0);
include('connection.php');;

if(isset($_REQUEST['btn_insert']))
{
	try
	{
		$name	= $_REQUEST['txt_name'];	//textbox name "txt_name"
		$idno	= $_REQUEST['int-number'];
		$image_file	= $_FILES["txt_file"]["name"];
		$type		= $_FILES["txt_file"]["type"];	//file name "txt_file"	
		$size		= $_FILES["txt_file"]["size"];
		$temp		= $_FILES["txt_file"]["tmp_name"];
		
		$path="../admin/files/upload/".$image_file; //set upload folder path
		
		if(empty($name && $idno)){
			$errorMsg="Please Enter Name";
		}
		else if(empty($image_file)){
			$errorMsg="Please Select Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif' || $type=='document/pdf') //check file extension
		{	
			if(!file_exists($path)) //check file not exist in your upload folder path
			{
				if($size < 5000000) //check file size 5MB
				{
					move_uploaded_file($temp, "../admin/files/upload/" .$image_file); //move upload file temperory directory to your upload folder
				}
				else
				{
					$errorMsg="Your File To large Please Upload 5MB Size"; //error message file size not large than 5MB
				}
			}
			else
			{	
				$errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
			}
		}
		else
		{
			$errorMsg="Upload JPG , JPEG , PNG & GIF File Formate.....CHECK FILE EXTENSION"; //error message file extension
		}
		
		if(!isset($errorMsg))
		{
			$insert_stmt=$db->prepare('INSERT INTO tbl_uploads(name,idno,image) VALUES(:fname,:idnumber,:fimage)'); //sql insert query					
			$insert_stmt->bindParam(':fname',$name);
			$insert_stmt->bindParam(':idnumber',$idno);
			$insert_stmt->bindParam(':fimage',$image_file);	  //bind all parameter 
		
			if($insert_stmt->execute())
			{
				$insertMsg="File Upload Successfully........"; //execute query success message
				header("refresh:3;add.php"); //refresh 3 second and redirect to index.php page
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
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

<style type="text/css">
	body{
		font-family: "Roboto",sans-serif;
	}
  #content{
  width: 50%;
  margin: 20px auto;
  border: 1px solid #cbcbcb;
}
form{
  width: 50%;
  margin: 20px auto;
}
form div{
  margin-top: 5px;
}
#img_div{
  width: 80%;
  padding: 5px;
  margin: 15px auto;
  border: 1px solid #cbcbcb;
}
#img_div:after{
  content: "";
  display: block;
  clear: both;
}
img{
  float: left;
  margin: 5px;
  width: 300px;
  height: 140px;
}
.hero-banner2{
background:url(../img/banner/ceps4.png) left center no-repeat;
background-size:cover;
position:relative;
z-index:1;
padding-top:75px;
padding-bottom:70px}
@media (min-width: 600px){
.hero-banner2{
padding-top:50px;
padding-bottom:10px}}
@media (min-width: 1200px){
.hero-banner2{padding-top:0px;
padding-bottom:220px}}
.hero-banner2::after{
content:"";
display:block;
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
z-index:-1;
opacity:.6}
.hero-banner2 h1{
color:#fff;
font-family: Rockwell;
text-transform:uppercase;
margin-bottom:20px}
@media (min-width: 992px){
.hero-banner2 h1{
margin-bottom:40px}}
.hero-banner>*{color:#fff}
.hero-subtitle{
max-width:550px;
margin-right:auto;
margin-left:auto;
margin-bottom:20px}

</style>
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
            <h2>Upload your file here</h2>



            <div class="row pace-theme-big-counter">
                <div class="col-lg-6">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                			<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
			</div>
        <?php
		}
		?> 

                                
       <form method="post" class="form-horizontal" enctype="multipart/form-data">
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Full Name</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" placeholder="enter name" />
				</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label">Identity Number</label>
				<div class="col-sm-6">
				<input type="text" minlength="8" maxlength="10" name="int-number" class="form-control" placeholder="enter number" />
				</div>
				</div>
					
					
				<div class="form-group">
				<label class="col-sm-3 control-label">File</label>
				<div class="col-sm-6">
				<input type="file" name="txt_file" class="form-control" />
				</div>
				</div>
					
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_insert" class="btn btn-success " value="Upload">
				<a href="add.php" class="btn btn-danger">Cancel</a>
				</div>
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