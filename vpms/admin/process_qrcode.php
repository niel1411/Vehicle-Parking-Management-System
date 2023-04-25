<?php 

if(isset($_POST['qrCodeMessage'])) {
    // Retrieve the data from the POST request
    $qrCodeMessage = $_POST['qrCodeMessage'];
    $qrCodeArray = explode(' ', $qrCodeMessage);
    $result = $qrCodeArray[0];
    $result1 = $qrCodeArray[1];
    $result2 = $qrCodeArray[2];
    $result3 = $qrCodeArray[3];
    $result4 = $qrCodeArray[4];
    
    // Insert the data into the database
    $con = mysqli_connect('localhost','root','','vpmsdb');
    $sql = "INSERT INTO tblregqr (Firstname, Lastname, PhoneNumber, PlateNumber, Email) VALUES ('$result', '$result1', '$result4', '$result3', '$result2')";
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