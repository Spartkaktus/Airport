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
    $selected_flight = $_POST['selected_flight'];
    $new_password = $_POST['new_password'];
    $new_status = $_POST['new_status'];


    if (!empty($new_status)) {
        $change_status_query = "UPDATE flights SET Flight_status = '$new_status' WHERE Flight_id = '$selected_flight'";
        mysqli_query($conn, $change_status_query);
    }

    // Redirect or display a success message after changes
    // For example:
    header("Location: admin_panel.php");
    exit();
}
?>
