<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>VPMS - Manage Category</title>
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

  <?php
  include_once('/xampp/htdocs/Vehicle parking Management System in PHP/vpms/admin/includes/sidebar.php');?>

    <!-- Left Panel -->

    <!-- Right Panel -->

     <?php include_once('/xampp/htdocs/Vehicle parking Management System in PHP/vpms/admin/includes/header.php');?>

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
                                    <li><a href="/xampp/htdocs/Vehicle parking Management System in PHP/vpms/admin/dashboard.php">Dashboard</a></li>
                                    <li><a href="/xampp/htdocs/Vehicle parking Management System in PHP/vpms/admin/qrcode-admin/qr.php">QrCode Generator</a></li>
                                    <li class="active">QrCode Generator</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <body>
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
							$first_name = "";
							$last_name = "";
							$email = "";
							$platenumber = "";
							$mobilenumber = "";

							if (isset($_POST["btnsubmit"])) {
									$first_name = $_POST["first_name"];
									$last_name = $_POST["last_name"];
									$email = $_POST["email"];
									$platenumber = $_POST["platenumber"];
									$mobilenumber = $_POST["mobilenumber"];

									/*echo "<pre>";
                                    var_dump($_POST);
                                    echo "</pre>";*/
							}
							?>
							<div class="card-body">
								<form autocomplete="off" class="form" role="form" action="qr.php" method="post">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">First name:</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" required="true" placeholder="Your First Name" value="<?php echo $first_name;?>" name="first_name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Last name:</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" required="true" placeholder="Your Last Name" value="<?php echo $last_name;?>" name="last_name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Email:</label>
										<div class="col-lg-9">
											<input class="form-control" type="email" required="true" placeholder="Your Email" value="<?php echo $email;?>" name="email">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Plate Number:</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" required="true" placeholder="Your Plate Number" value="<?php echo $platenumber;?>" name="platenumber">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Mobile Number:</label>
										<div class="col-lg-9">
											<input class="form-control" type="text"	required="true" maxlength="11" pattern="[0-9]{11}" placeholder="Your Mobile Number"  value="<?php echo $mobilenumber;?>" name="mobilenumber">
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

									$codeString = $_POST["first_name"] . "\n";
									$codeString .= $_POST["last_name"] . "\n";
									$codeString .= $_POST["email"] . "\n";
									$codeString .= $_POST["platenumber"] . "\n";
									$codeString .= $_POST["mobilenumber"];

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

</body>

        <div class="clearfix"></div>

<?php include_once('/xampp/htdocs/Vehicle parking Management System in PHP/vpms/admin/includes/footer.php');?>

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
<?php   ?>