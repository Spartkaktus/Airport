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

if (isset($_POST["wyszukaj_pracownika"])) {
     //Showing all personel that fit criteria
     $result = mysqli_query($conn, "SELECT * FROM `airport_personel`");
          while($row = mysqli_fetch_array($result))
          {
            echo " Id pracownika: " . $row['Personel_id'] . "<br />"; 
            echo " Imię: " . $row['Name']. "<br />"; 
            echo " Nazwisko: " . $row['Surname']. "<br />";
            echo " Zawód: " . $row['Occupation']. "<br />";
            echo " Data zatrudnienia: " . $row['Date_of_employment']. "<br />";
            echo " Koniec umowy: " . $row['End_of_contract']. "<br />";
            echo " Typ umowy: " . $row['Contract_type']. "<br />";
            echo " Pensja: " . $row['Salary']. "(zł) <br />";
            echo " Dodatkowe informacje: " . $row['Additional_information']. "<br />";
            echo "<br />";
          }
     if($result) {}
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