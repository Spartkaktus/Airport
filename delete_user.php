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

if (isset($_POST["delete_user"])) {
    $selected_user = $_POST["selected_user"];

    // Deleting the selected user
    $delete_query = "DELETE FROM users WHERE `Login`='$selected_user'";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        echo "User deleted successfully.";
        header('Location: admin_panel.php');
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
        header('Location: admin_panel.php');
    }
}

?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>