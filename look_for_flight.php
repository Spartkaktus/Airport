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

if (isset($_POST["wyszukaj_lot"])) {
     $selected_flight = $_POST["selected_flight"];
     
     //Showing all flights that fit criteria
     $show_query = "SELECT * FROM flights WHERE `Flight_id`='$selected_flight'";
     $show_result = mysqli_query($conn, $show_query);

     if ($show_result) {
        $result = mysqli_query($conn, "SELECT * FROM flights WHERE `Flight_id`='$selected_flight'");
          while($row = mysqli_fetch_array($result))
          {
            echo " Id lotu: " . $row['Flight_id'] . "<br />"; 
            echo " Kierunek: Główne lotnisko -> " . $row['Destination']. "<br />"; 
            echo " Id samolotu: " . $row['Plane_id']. "<br />";
            echo " Data wylotu: " . $row['Date_of_departure']. "<br />";
            echo " Czas wylotu: " . $row['Departure_time']. "<br />";
            echo " Peron: " . $row['Departure_Gate']. "<br />";
            echo " Cena biletu: " . $row['Price']. " (zł) <br />";
            echo " Status lotu " . $row['Flight_status']. "<br />";
          }
     }
     else {
       echo "Error showing results: " . mysqli_error($conn);
       header('Location: admin_panel.php');
     }
}

?>
<a href="admin_panel.php">
    <button type="button">Powrót</button>
</a>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>