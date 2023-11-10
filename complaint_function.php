<?php
include 'config.php';

$cname = $_POST['cname'];
$phone = $_POST['phone'];
$product = $_POST['product'];
$sno = $_POST['sno'];
$mno = $_POST['mno'];
$b_name = $_POST['b_name'];
$tname = $_POST['tname'];
$w_date_from = $_POST['w_date_from'];
$w_date_to = $_POST["w_date_to"];
$address = $_POST["address"];
$complaint = $_POST["complaint"];
$complaint_date = date("Y-m-d H:i:s");

$sql = "INSERT INTO `complaint`(`customer_name`,`phone`,`product`,`serial_no`,`model_no`,`brand_id`,`Time`,`technician_name`,`warrenty_date_from`,`warrenty_data_to`,`address`,`complaint`)
VALUES ('$cname','$phone','$product','$sno','$mno','$b_name','$complaint_date','$tname','$w_date_from','$w_date_to','$address','$complaint')";

if ($con->query($sql) === true) {
    $last_inserted_id = $con->insert_id; // Get the last inserted ID
    echo "Complaint Registred successfully with ID: " . $last_inserted_id;
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}





//delete complaint




?>