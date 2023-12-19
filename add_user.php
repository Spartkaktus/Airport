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

if (isset($_POST["add_user"])) {
    $new_login = $_POST["new_login"];
    $new_password = $_POST["new_password"];
    $new_role = $_POST["new_role"];

    // Sprawdź czy dodawany użytkownik już istnieje
    $check_query = "SELECT * FROM users WHERE `Login`='$new_login'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "User already exists!";
    } else {

        $insert_query = "INSERT INTO users (`Login`, `Password`, `Level_of_access`) VALUES ('$new_login', '$new_password', '$new_role')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo "User added successfully.";
            header('Location: admin_panel.php');
            exit();
        } else {
            echo "Error adding user: " . mysqli_error($conn);
        }
    }
}
?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>