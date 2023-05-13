<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if($_GET['del']){
      $catid=$_GET['del'];
      mysqli_query($con,"delete from tblextravehicle where ID ='$catid'");
      echo "<script>alert('Data Deleted');</script>";
      echo "<script>window.location.href='manage-incomingvehicle.php'</script>";
              }
if(isset($_POST['submit']))
  {
    
    $cid=$_GET['viewid'];
      $remark=$_POST['remark'];
      $status=$_POST['status'];
      $parkingcharge=$_POST['parkingcharge'];
     
 
    
     
   $query=mysqli_query($con, "update  tblvehicle set Remark='$remark',Status='$status',ParkingCharge='$parkingcharge' where ID='$cid'");
    if ($query) {
    
     echo "<script>alert('All remarks has been updated');</script>";
  }
  else
    {
    echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }

  
} 

        
        
         

  ?>
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>VPMS - View Vehicle Detail</title>
   
    <link   rel="icon"  href="favicon.ico">
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Left Panel -->

  <?php include_once('includes/sidebar.php');?>

    <!-- Left Panel -->

    <!-- Right Panel -->

     <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="manage-incomingvehicle.php">View Vehicle</a></li>
                                    <li class="active">Incoming Vehicle</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                   
         

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">View Incoming Vehicle</strong>
                        </div>
                        <div class="card-body">
                  
              <?php
 $cid=$_GET['viewid'];
$ret=mysqli_query($con,"select * from tblvehicle where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>                       <table border="1" class="table table-bordered mg-b-0">
   
   <tr>
                                <th>Parking Number</th>
                                   <td><?php  echo $row['ParkingNumber'];?></td>
                                   </tr>                             
<tr>
                                <th>Vehicle Category</th>
                                   <td><?php  echo $row['VehicleCategory'];?></td>
                                   </tr>
                                   <tr>
                                <th>Vehicle Company Name</th>
                                   <td><?php  echo $packprice= $row['VehicleCompanyname'];?></td>
                                   </tr>
                                <tr>
                                <th>Registration Number</th>
                                   <td><?php  echo $row['RegistrationNumber'];?></td>
                                   </tr>
                                   <tr>
                                    <th>Owner Name</th>
                                      <td name="owner" value="<?php  echo $row['OwnerName'];?>" ><?php  echo $row['OwnerName'];?></td>
                                  </tr>
                                      <tr>  
                                       <th>Owner Contact Number</th>
                                        <td><?php  echo $row['OwnerContactNumber'];?></td>
                                    </tr>
                                    <tr>
                               <th>In Time</th>
                                <td><?php  echo $row['InTime'];?></td>
                            </tr>
                            <tr>
    <th>Status</th> 
    <td> <?php  
if($row['Status']=="")
{
  echo "Vehicle In";
}
if($row['Status']=="Out")
{
  echo "Vehicle out";
}

     ;?></td>
  </tr>
</table>

                    </div>
                </div>
                <table class="table mb-0">

<?php if($row['Status']==""){ ?>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    

  <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="" rows="12" cols="14" class="form-control" ></textarea></td>
  </tr>
 <tr>
<th>Parking Charge: </th>
<td>
  <input type="text" name="parkingcharge" id="parkingcharge" class="form-control" >
</td></tr>
<tr>
    <th>Status :</th>
    <td>
   <select name="status" class="form-control" required="true" >
     <option value="Out">Outgoing Vehicle</option>
   </select></td>
  </tr>
  <tr>
    <th>Add Vehicle :</th>
    <td>
      <p>Existing Owner</p>
   <input name="owner" class="form-control" required="true" value="<?php echo $row['OwnerName']?>" ></input>
      <p>Plate Number</p>
   <input name="plate" class="form-control" required="true" placeholder="Plate number" ></input>
   
   <input type="submit" class="btn btn-primary btn-sm" name='update'></button>
    <?php 
    
    if(isset($_POST['update'])) {
      $parkingnumber = mt_rand(100000000, 999999999);
      $ownername = $_POST['owner'];
      $plate = $_POST['plate']; 
    
    
      $sql = "INSERT INTO tblextravehicle (ParkingNumber,OwnerName, RegistrationNumber) VALUES ('$parkingnumber','$ownername','$plate')";
      $result = mysqli_query($con, $sql);
    
      if (!$result) {
        die("Query failed: " . mysqli_error($con));
       }
    
        // Exit the script to prevent any further output
        mysqli_close($con);
        
     }
    
    ?>
  </td>
  </tr>
                                 
                                    
                                    
                                 <tr>  <p style="text-align: center;"><td> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Update</button></p></td></tr>
                                </form>
                            </table>


                            <table border="1" class="table table-bordered mg-b-0">
<tr>  
              <th>Other Vehicles</th>
              <tr>
                <th>Parking Number</th>
                <th>Owner Name</th>
                <th>Plate Number</th>
                <th>Actions</th>
              </tr>
              
            <td>
            <?php
            
              $ownername = $_POST['owner'];
                        
              $con = mysqli_connect("localhost", "root", "", "vpmsdb");
              if(mysqli_connect_errno()){
                  echo "Connection Fail".mysqli_connect_error();
              }
              $sql = "SELECT * FROM tblextravehicle WHERE OwnerName='$ownername'";
              $result = mysqli_query($con, $sql);
              // Loop through the data and display it
              while($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
            
              <td><?php echo $row['ParkingNumber']; ?></td>
              <td><?php echo $row['OwnerName']; ?></td>
              <td><?php echo $row['RegistrationNumber']; ?></td>
              <td><a href="view-incomingvehicle-detail.php?del=<?php echo $row['ID'];?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
              <!-- ...and so on for other columns -->
           </tr>
           
           <?php
              }
              
              // Redirect to the manage dashboard page
              header("Location: manage-incomingvehicle.php");
              exit; // Make sure to exit after the redirect
          ?>
</table>
<?php 


} else { ?>
    <table border="1" class="table table-bordered mg-b-0">
  <tr>
    <th>Remark</th>
    <td><?php echo $row['Remark']; ?></td>
  </tr>
<tr>
   <tr>
    <th>Parking Fee</th>
   <td><?php echo $row['ParkingCharge']; ?></td>
  </tr>

  

  

<?php } ?>


</table>


  

  

<?php } ?>
            </div>



        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

<?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>