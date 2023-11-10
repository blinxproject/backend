<?php
include 'config.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Check if the necessary keys are set in the $_POST array
    if (isset($_POST['id'], $_POST['cus_name'], $_POST['cus_phone'], $_POST['product'], $_POST['ser_no'], $_POST['mod_no'], $_POST['tec_name'])) {

        $id = $_POST['id'];
        $cname = $_POST['cus_name'];
        $phone = $_POST['cus_phone'];
        $product = $_POST['product'];
        $sno = $_POST['ser_no'];
        $mno = $_POST['mod_no'];
        $tname = $_POST['tec_name'];

        // Perform the SQL update
        $sql = "UPDATE complaint SET
                customer_name = '$cname',
                phone = '$phone',
                product = '$product',
                serial_no = '$sno',
                model_no = '$mno',
                technician_name = '$tname'
                WHERE id = $id";

        if ($con->query($sql) === true) {
            // Update successful
            echo "Complaint updated successfully";
        } else {
            // Update failed
            echo "Error updating complaint: " . $con->error;
        }

        // Close the database connection
        $con->close();
    } else {
        // Handle the case where required keys are not set
        echo "Invalid data received";
    }
} else {
    // Handle the case where this script is not accessed via a POST request
    echo "Invalid request";
}