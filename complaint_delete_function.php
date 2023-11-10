<?php
include 'config.php';

if (isset($_POST['deletesend'])) {
    $uniqu = $_POST['deletesend'];

    $sql = "DELETE FROM `complaint` WHERE id = $uniqu";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Complaint Deleted Successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}




?>