<?php 
session_start();
include "../db/db_conn.php";



if (isset($_GET['id'])) {
    // Assuming you have a function to fetch retailer data from your database
    $retailerId = $_GET['id'];
    // $retailerData = fetchRetailerDataById($retailerId); // Implement this function according to your database structure
    $sql =  "SELECT * FROM retailers WHERE id = '$retailerId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        // the user name must be unique
        $row = mysqli_fetch_assoc($result);
        $retailerData = array($row);
        header('Content-Type: application/json');
        echo json_encode($retailerData);
    } else {
        // $retailerData = array();
        header('Content-Type: application/json');
        echo json_encode($retailerData);
    }
    
} else {
    $sql1 =  "SELECT * FROM retailers";
    $result = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result) > 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $retailerData[] = $row; // Append each row to the retailer data array
        }
        header('Content-Type: application/json');
        echo json_encode($retailerData);
    } else {
        echo "Retailer ID is missing.";
    }
}

// // Function to fetch retailer data from database based on retailer ID
// function fetchRetailerDataById($retailerId) {
//     // include "../db_conn.php";
//     // Implement your database query here to fetch retailer data based on retailer ID
//     $sql =  `SELECT * FROM retailers WHERE id = '$retailerId'`;
//     // $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
//         // 
//        $result = mysqli_query($conn, $sql);

//         if (mysqli_num_rows($result) === 1) {
//         	// the user name must be unique
//         	$row = mysqli_fetch_assoc($result);
//         	// if ($row['password'] === $password && $row['role'] == $role) {
//         	// 	$_SESSION['name'] = $row['name'];
//         	// 	$_SESSION['id'] = $row['id'];
//         	// 	$_SESSION['role'] = $row['role'];
//         	// 	$_SESSION['username'] = $row['username'];

//             // }
//         }
//     // Execute your query and fetch the data from database

//     // For the sake of example, I'll create a sample data array
//     // Replace this with your actual database query
//     $retailerData = array(
//         'company_name' => 'Company XYZ',
//         'retailer_name' => 'John Doe',
//         'mobile_no' => '1234567890',
//         'email' => 'john@example.com',
//         'gst_no' => 'GST123456',
//         'address' => '123 Street, City, Country'
//     );

//     return $retailerData;
// }
?>