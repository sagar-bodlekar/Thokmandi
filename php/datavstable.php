<?php
session_start();
include "../db/db_conn.php";


/**
 * this page for all retrive data for datatable 
 * Orders
 * Products
 * Retailers
 * Salesman
 * Transports 
 */
                $sql = '';
            //    $var = json_encode($_GET['value']);
               $var = isset($_GET['value']) ? $_GET['value'] : '';
               if ($var == 'Products') {
                $sql .=  "SELECT * FROM products";
               } elseif ($var == 'Retailers') {
                $sql .=  "SELECT * FROM retailers";
               } elseif ($var == 'Salesman') {
                $sql .=  "SELECT * FROM salesman";
               } elseif ($var == 'Transports') {
                $sql .=  "SELECT * FROM transport";
               } elseif ($var == 'Orders') {
                // order_invoice  order_summery
                // $sql .=  "SELECT A.id, A.invoice_no, A.retailer_id, A.orderstatus, A.salesman_id, A.transport_id, A.created_at, A.updated_at FROM order_invoice A JOIN order_summery B ON A.id = B.order_id";
                $sql .= "SELECT id, invoice_no, retailer_id, orderstatus, salesman_id, transport_id, created_at,updated_at FROM order_invoice";
               } elseif ($var == 'order_summery') {
                # code...$_GET['id']
                // echo $var;
                // echo $_GET['id'];
                // die;
                $sql .= "SELECT A.id AS Id, A.order_id AS OrderId, B.product_name AS Product_Name, A.qty AS QTY, A.inword_qty AS Inword_Qty, A.total_price AS Total_Price, A.status AS Product_Status, B.created_at AS Create_Date, B.updated_at AS Update_Date FROM $var A JOIN products B ON A.product_id = B.id WHERE order_id='" . $_GET['id'] . "'";
               }
            
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sagar = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $sagar[] = $row; // Append each row to the retailer data array
                }
                header('Content-Type: application/json');
                echo json_encode($sagar);
            } else {
                // Handle errors
                echo "Error: " . mysqli_error($conn);
            }
    //    $result = mysqli_query($conn, $sql);
            //    if (mysqli_num_rows($result) > 1) {
            //     $sagar = array();
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $sagar[] = $row; // Append each row to the retailer data array
            //     }
            //     header('Content-Type: application/json');
            //     echo json_encode($sagar);
            //     }   
?>