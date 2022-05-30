<?php

    session_start();
error_reporting(0);
include('connection.php');
    
    if(isset($_REQUEST['delete_id']))
    {
        // select image from db to delete
        $id=$_REQUEST['delete_id']; //get delete_id and store in $id variable
        
        $select_stmt= $db->prepare('SELECT * FROM tbl_uploads WHERE id =:id');  //sql select query
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("upload/".$row['image']); //unlink function permanently remove your file
        
        //delete an orignal record from db
        $delete_stmt = $db->prepare('DELETE FROM tbl_uploads WHERE id =:id');
        $delete_stmt->bindParam(':id',$id);
        $delete_stmt->execute();
        
        // header("Location:index.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Curfew e-Pass Management System - apply</title>
        
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
        
</head>

    <body>
    
    
    <nav class="navbar navbar-default navbar-static-top" style="background-color: #007bff">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div id="navbar" class="navbar-collapse collapse">
          <div class="logo">
                        <img src="cepms.PNG" alt="CePM" width="250" height="80" style="border-radius: 30px; margin-left: 0px;">
                    </div>
          
        </div>
        

        </div><!--/.nav-collapse -->
      </div>
    </nav>










    <div class=""><h2>Applicant files</h2></div>
    <div class="wrapper">
    
    <div class="container">
            
        <div class="col-lg-12">
            <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                           <h3><a href="add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add File</a></h3>
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Id Number</th>
                                            <th>File</th>
                                            <th>View Image</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $select_stmt=$db->prepare("SELECT * FROM tbl_uploads"); //sql select query
                                    $select_stmt->execute();
                                    while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['idno']; ?></td>
                                            <td><img src="upload/<?php echo $row['image']; ?>" width="100px" height="60px"></td>
                                            <td><a href="upload/<?php echo $row['image']; ?>" target="_blank">View</a></td>
                                            <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
        </div>
        
    </div>
            

    </div>


  <!-- ================ start footer Area ================= -->
   <?php include_once('footer.php');?>
  <!-- ================ End footer Area ================= -->
                                    
    </body>
</html>