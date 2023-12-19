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

if (isset($_POST["usun"])) {
    $selected_plane = $_POST["selected_vehicle"];


    // Deleting the selected user
    $delete_query = "DELETE FROM planes WHERE `Plane_id`='$selected_plane'";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        echo "Vehicle deleted successfully.";
        header('Location: admin_panel.php');
    } else {
        echo "Error deleting vehicle: " . mysqli_error($conn);
        header('Location: admin_panel.php');
    }
}

?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>