<?php 

if(isset($_POST['qrCodeMessage'])) {
    // Retrieve the data from the POST request
    $parkingnumber=mt_rand(100000000, 999999999);
    $qrCodeMessage = $_POST['qrCodeMessage'];
    $qrCodeArray = explode(' ', $qrCodeMessage);

    $result = $qrCodeArray[0];
    $result1 = $qrCodeArray[1];
    $result2 = $qrCodeArray[2];
    $result3 = $qrCodeArray[3] . ' ' . $qrCodeArray[4];
    $result4 = $qrCodeArray[5];
    
    // Insert the data into the database
    $con = mysqli_connect('localhost','root','','vpmsdb');
    $sql = "INSERT INTO tblvehicle (ParkingNumber, VehicleCategory, VehicleCompanyname, RegistrationNumber, OwnerName, OwnerContactNumber) VALUES ('$parkingnumber','$result', '$result1', '$result2', '$result3', '$result4')";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        // Return a success response to the client
        echo json_encode(['success' => true]);
    } else {
        // Return an error response to the client
        echo json_encode(['success' => false, 'message' => 'Error inserting data into database.']);
    }
    
    // Exit the script to prevent any further output
    mysqli_close($con);
    exit();
}

?>