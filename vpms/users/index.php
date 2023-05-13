<!doctype html>
 <html class="no-js" lang="">
<head>
    
    <title>VPMS-Login Page</title>
   
    <link   rel="icon"  href="favicon.png">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../admin/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body>
<?php
		session_start();
		error_reporting(0);
		include('C:\xampp\htdocs\Vehicle parking Management System in PHP\vpms\users\includes\dbconnection.php');
		if (strlen($_SESSION['vpmsaid']==0)) {
		header('location:logout.php');
		} else{

		if(isset($_POST['submit']))
		{
			$parkingnumber=mt_rand(100000000, 999999999);
			$catename=$_POST['catename'];
			$vehcomp=$_POST['vehcomp'];
			$vehreno=$_POST['vehreno'];
			$ownername=$_POST['ownername'];
			$ownercontno=$_POST['ownercontno'];
			$enteringtime=$_POST['enteringtime'];
			
			
			$query=mysqli_query($con, "insert into  tblvehicle(ParkingNumber,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber) value('$parkingnumber','$catename','$vehcomp','$vehreno','$ownername','$ownercontno')");
			if ($query) {
		echo "<script>alert('Vehicle Entry Detail has been added');</script>";
		echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
		}
		else
			{
			echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
			}

		
		}
	}
	?>
<body class="bg-dark">
	<div class="container py-3">

	<div class="container py-3">

<div class="row">
	<div class="col-md-12"> 

		<div class="row justify-content-center">
			<div class="col-md-6">
				<!-- form user info -->
				<div class="card card-outline-secondary">
					<div class="card-header">
						<h3 class="mb-0">RTUVPMS QRCODE GENERATOR</h3>
					</div>
					
					<?php
					$Select_Category = "";
					$Vehicle_Company = "";
					$Plate_Number = "";
					$Owner_Name = "";
					$Mobile_Number = "";

					if (isset($_POST["btnsubmit"])) {
						$Select_Category = $_POST["Select_Category"];
						$Vehicle_Company = $_POST["Vehicle_Company"];
						$Plate_Number = $_POST["Plate_Number"];
						$Owner_Name = $_POST["Owner_Name"];
						$Mobile_Number = $_POST["Mobile_Number"];

							/*echo "<pre>";
							var_dump($_POST);
							echo "</pre>";*/
					}
					?>
					<div class="card-body card-block">
						<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
							

							<div class="row form-group">
								<div class="col col-md-3"><label for="select" class=" form-control-label">Vehicle Category:</label></div>
								<div class="col-12 col-md-9">
									<select name="Select_Category" id="catename" class="form-control" value="<?php echo $Select_Category;?>" name="Select_Category">
										<option value="0">Select Category</option>
										<?php $query=mysqli_query($con,"select * from tblcategory");
	  while($row=mysqli_fetch_array($query))
	  {
	  ?>    
										 <option value="<?php echo $row['VehicleCat'];?>"><?php echo $row['VehicleCat'];?></option>
		  <?php } ?> 
									</select>
								</div>
							</div>
							<div class="row form-group">
								<div class="col col-md-3"><label for="text-input" class=" form-control-label">Vehicle Company:</label></div>
								<div class="col-12 col-md-9"><input type="text" id="vehcomp" name="Vehicle_Company" class="form-control" placeholder="Vehicle Company" required="true" value="<?php echo $Vehicle_Company;?>" name="Vehicle_Company"></div>
							</div>
						 
							 <div class="row form-group">
								<div class="col col-md-3"><label for="text-input" class=" form-control-label">Plate Number:</label></div>
								<div class="col-12 col-md-9"><input type="text" id="vehreno" name="Plate Number" class="form-control" placeholder="Plate Number" required="true"  value="<?php echo $Plate_Number;?>" name="Plate_Number"></div>
							</div>
							<div class="row form-group">
								<div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Name:</label></div>
								<div class="col-12 col-md-9"><input type="text" id="ownername" name="Owner Name" class="form-control" placeholder="Your Fullname" required="true" value="<?php echo $Owner_Name;?>" name="Owner_Name"></div>
							</div>
						
							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label">Mobile Number:</label>
								<div class="col-lg-9">
									<input class="form-control" type="text"	required="true" maxlength="11" pattern="[0-9]{11}" placeholder="Your Mobile Number"  value="<?php echo $Mobile_Number;?>" name="Mobile_Number">
								</div>
							</div> 

							


							<div class="form-group row">
								<label class="col-lg-3 col-form-label form-control-label"></label>
								<div class="col-lg-9">
									<input class="btn btn-success btn-flat m-b-30 m-t-30" type="submit" name="btnsubmit" value="Generate QR Code">
								</div>

						   
							
							
							</div>
						</form>
						<?php
 									include "phpqrcode/qrlib.php";
 									$PNG_TEMP_DIR = 'temp/';
 									if (!file_exists($PNG_TEMP_DIR))
									    mkdir($PNG_TEMP_DIR);

									$filename = $PNG_TEMP_DIR . 'test.png';

									if (isset($_POST["btnsubmit"])) {

									$codeString = $_POST["Select_Category"] . "\n";
									$codeString .= $_POST["Vehicle_Company"] . "\n";
									$codeString .= $_POST["Plate_Number"] . "\n";
									$codeString .= $_POST["Owner_Name"] . "\n";
								
									$codeString .= $_POST["Mobile_Number"];

									$filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';

									QRcode::png($codeString, $filename);

									echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" /><hr/>';
								}

								?>
							</div>
						</div><!-- /form user info -->
					</div>
				</div>

			</div><!--/col-->
		</div><!--/row-->

	</div><!--/container-->

	<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../admin/assets/js/main.js"></script>

</body>
</html>