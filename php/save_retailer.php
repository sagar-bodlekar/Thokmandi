<?php 
session_start();
include "../db/db_conn.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a function to fetch retailer data from your database
    $companyName = $_POST['company_name'];
    $retailerName = $_POST['retailer_name'];
    $mobileNo = $_POST['mobile_no'];
    $email = $_POST['email'];
    $gstNo = $_POST['gst_no'];
    $address = $_POST['address'];
    // $retailerData = fetchRetailerDataById($retailerId); // Implement this function according to your database structure
    $sql =  "INSERT INTO retailers (company_name,retailer_name,mobile_no,email,gst_no,address)VALUES(?,?,?,?,?,?)";
    // $result = mysqli_query($conn, $sql);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $companyName, $retailerName, $mobileNo, $email, $gstNo, $address);
    if ($stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode("Successfully Added Retailers");
    } else {
        // $retailerData = array();
        header('Content-Type: application/json');
        echo json_encode("Throw Error");
    }
    
} 

?>