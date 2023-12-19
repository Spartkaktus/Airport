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

if (isset($_POST["wyszukaj_samolot"])) {
     //Showing all planes that fit criteria
     $result = mysqli_query($conn, "SELECT * FROM planes");
     while($row = mysqli_fetch_array($result))
          {
            echo " Id samolotu: " . $row['Plane_id'] . "<br />"; 
            echo " Nazwa samolotu: " . $row['Name']. "<br />"; 
            echo " Data ostatniego przeglądu: " . $row['Last_checkup_date']. "<br />";
            echo " Maksymalna ilość miejsc: " . $row['Amount_of_seats']. "<br />";
}
     if ($result) {
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