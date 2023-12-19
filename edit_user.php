<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airport";

$conn = @mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "Error: " . mysqli_connect_error();
    exit();
}
mysqli_set_charset($conn, "utf8"); // ustawienie polskich znakow

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_user = $_POST['selected_user'];
    $new_password = $_POST['new_password'];
    $new_login = $_POST['new_login'];

    if (!empty($new_password)) {
        // Change password query
        $change_password_query = "UPDATE users SET Password = '$new_password' WHERE Login = '$selected_user'";
        mysqli_query($conn, $change_password_query);
    }

    if (!empty($new_login)) {
        // Change login query
        $change_login_query = "UPDATE users SET Login = '$new_login' WHERE Login = '$selected_user'";
        mysqli_query($conn, $change_login_query);
    }

    // Redirect or display a success message after changes
    // For example:
    header("Location: admin_panel.php");
    exit();
}
?>
