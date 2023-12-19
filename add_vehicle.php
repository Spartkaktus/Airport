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
if (isset($_POST["dodaj"])) {
    $selected_vehicle = $_POST["selected_vehicle"];
    $vehicle_name = $_POST["name"];
    $amount_of_seats = $_POST["amount_of_seats"];
    $id = $_POST["id"];
    $Last_checkup_date = date("Y-m-d");

    // Sprawdź czy dodawany pojazd już istnieje
    $check_query = "SELECT * FROM planes WHERE `Name`='$vehicle_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Vehicle already exists!";
    } else {
        $insert_query = "INSERT INTO planes (`Plane_id`,`Name`, `Last_checkup_date`, `Amount_of_seats`) VALUES ('$id','$vehicle_name', '$Last_checkup_date', '$amount_of_seats')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo "Vehicle added successfully.";
            header('Location: admin_panel.php');
            exit();
        } else {
            echo "Error adding vehicle: " . mysqli_error($conn);
        }
    }
}
?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>