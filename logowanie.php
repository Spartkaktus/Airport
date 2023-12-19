<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
      <div id="container">
          <div id="logo">
              <img src="logo.png" width="150" height="150">
              Centrum informacji
          </div>
          <div id="topbar">
              <br/>
              <br/>
          </div>
          <div id="content">
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

if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT User_id, Level_of_access FROM users WHERE `Login`='$login' AND `Password`='$password';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Set session variable for user ID
        $_SESSION['user_id'] = $data['User_id']; // Assuming 'id' is the column storing user IDs

        // Redirect based on user role
        if ($data['Level_of_access'] == "Admin" || $data['Level_of_access'] == "Employee") {
            header('Location: admin_panel.php');
            exit();
        } elseif ($data['Level_of_access'] == "Customer") {
            header('Location: index.php');
            exit();
        }
    } else {
        echo "Nieprawidłowe Dane.";
        header('Refresh: 2; URL=log_form.php');
        exit();
    }
} else {
    echo "Brak danych logowania."; 
}
?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>