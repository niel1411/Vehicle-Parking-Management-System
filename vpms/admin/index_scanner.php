
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
<?php
// get the q parameter from URL

$q = isset($_REQUEST["q "]);
$con = mysqli_connect('localhost','root','','vpmsdb');
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// lookup all hints from array if $q is different from ""
if ($q !="") {
  $result=mysqli_query($con,"SELECT * FROM tblregqr");
  $rowcount=mysqli_num_rows($result);

  if($rowcount==0){
    $ret=mysqli_query($con,"INSERT INTO `tblregqr`(Firstname, Lastname, PhoneNumber, PlateNumber, Email) VALUES ('$q',NOW())");

    if($ret)
    {
      echo '<div class="alert alert-success"><strong>Success!</strong> employee successfully registered</div>' . date('l jS \of F Y h:i:s A');
    }
    else
    {
      // handle error
    }
  }
  else{
    //echo 'Owner is already registered';  
    echo '<div class="alert alert-success"><strong>Success! </strong> Owner is successfully registered</div>' . date('l jS \of F Y h:i:s A');
  }
}

?>

<script src="ht.js"></script>

<style>
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
</style>

</head>
<body>

<div class="row">
  <div class="col">
    <div style="width:500px;" id="reader"></div>
  </div>

  <audio id="myAudio1">
    <source src="success.mp3" type="audio/ogg">
  </audio>
  <audio id="myAudio2">
    <source src="failes.mp3" type="audio/ogg">
  </audio>

  <script>
    var x = document.getElementById("myAudio1");
    var x2 = document.getElementById("myAudio2");      
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
      }
    }

    function playAudio() { 
      x.play(); 
    } 
  </script>

  <div class="col" style="padding:30px;">
    <h4>SCAN RESULT</h4>
    <div>Owner's Details</div>
    <form action="">
      <input type="text" name="start" class="input" id="result" onkeyup="showHint(this.value)" placeholder="result here" readonly="" />
    </form>
     <br><input type="text" name="start" class="input" id="result1" onkeyup="showHint(this.value)" placeholder="result here" readonly="" /></form></br>
     <br><input type="text" name="start" class="input" id="result2" onkeyup="showHint(this.value)" placeholder="result here" readonly="" /></form></br>
     <br><input type="text" name="start" class="input" id="result3" onkeyup="showHint(this.value)" placeholder="result here" readonly="" /></form></br>
     <br><input type="text" name="start" class="input" id="result4" onkeyup="showHint(this.value)" placeholder="result here" readonly="" /></form></br>


     <p>Status: <span id="txtHint"></span></p>
  </div>
</div>
<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    document.getElementById("result").value = qrCodeMessage;
    var qrCodeArray = qrCodeMessage.split(" ");
    document.getElementById("result").value = qrCodeArray[0];
    document.getElementById("result1").value = qrCodeArray[1];
    document.getElementById("result2").value = qrCodeArray[2];
    document.getElementById("result3").value = qrCodeArray[3];
    document.getElementById("result4").value = qrCodeArray[4];

    showHint(qrCodeMessage);
    playAudio();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_qrcode.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send('qrCodeMessage=' + encodeURIComponent(qrCodeMessage));
}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>

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