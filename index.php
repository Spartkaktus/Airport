<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="style_login.css" type="text/css"/>
	</head>
	<body>
      <div id="container">
          <div id="logo">
             <div id="logoR">
             </div>
             <div id="logoL">
             </div>
             <div style="clear:both;"></div>
          </div>
          <div id="topbar">
          <img src="logo.png" width="150" height="150">
          </div>
             <div id="topbarL">
             </div>
             <div id="topbarR">
             </div>
             <div style="clear:both;"></div>
          <div id="content">
<?php
session_start();
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "airport";
		

		$conn = @mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) 
		{
			echo "Error: " . mysqli_connect_error();
			exit();
		}
		mysqli_set_charset($conn,"utf8"); //ustawienie polskich znakow


?>

	<form action="logowanie.php" method="POST">
			login </br> <input type="text" name="login" required> </br>
			hasło </br> <input type="text" name="password" required></br>
			<input type="checkbox" name="remember"/>Zapamiętaj mnie </br>
			<input type="submit" value="zaloguj"/></br>
	</form>
</body>
</html>
</div>
           <div id="footer">
           </div>
              <div id="footerL">
              </div>
              <div id="footerR">
              </div>
              <div style="clear:both;"></div>