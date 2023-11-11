<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE `username`='$username' and `password`='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = 'Your User/Mail Or Password is wrong';
        echo json_encode(array('status' => 'error', 'message' => 'Invalid username/mail or password'));
    } else {
        while ($row = $result->fetch_assoc()) {
            $type = $row['user_type_id'];
            $email = $row['email'];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];

            $_SESSION["email"] = $row["email"];
            $_SESSION["id"] = $row['id'];

         if ($type == 3) {
                $_SESSION["type"] = $type;
                echo json_encode(array('status' => 'success', 'redirect' => '../Admin/index.php'));
            } else if ($type == 1) {
                echo json_encode(array('status' => 'success', 'redirect' => '../ShopManager/index.php'));
            }
        }
    }
}
?>
