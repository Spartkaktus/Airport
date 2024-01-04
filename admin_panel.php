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

// Wyciągnij id usera z sesji
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $select_user_query = "SELECT Level_of_access FROM users WHERE User_id='$user_id'";
    $user_result = mysqli_query($conn, $select_user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_role = $user_row['Level_of_access'];

        // Wyświetl zawartość strony w zależności od roli
        if ($user_role === "Admin") {
            // Content visible for administrators
            ?>
            <!-- Form dodający użytkownika -->
            <form method="post" action="add_user.php">
                <input type="text" name="new_login" placeholder="New User Login" required><br>
                <input type="password" name="new_password" placeholder="New User Password" required><br>
                Rola dodawanego użytkownika:
                <select name="new_role">
                    <option value="Admin">Administrator</option>
                    <option value="Customer">Klient</option>
                    <option value="Employee">Pracownik</option>
                </select><br>
                <input type="submit" name="add_user" value="Add User">
            </form>

            <!-- Form usuwający użytkownika -->
            <form method="post" action="delete_user.php">
                Wybierz użytkownika do usunięcia:
                <select name="selected_user">
                    <?php
                    $select_employee_query = "SELECT Login FROM users WHERE `Level_of_access`='Admin' OR `Level_of_access`='Employee'";
                    $employee_result = mysqli_query($conn, $select_employee_query);

                    while ($employee_row = mysqli_fetch_assoc($employee_result)) {
                        echo "<option value='" . $employee_row['Login'] . "'>" . $employee_row['Login'] . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="delete_user" value="Delete User">
            </form>

            <!-- Form edytujący dane użytowników -->
            <form method="post" action="edit_user.php">
    Wybierz użytkownika do edycji:
    <select name="selected_user">
        <?php
        $select_employee_query = "SELECT Login FROM users WHERE `Level_of_access`='Employee' OR `Level_of_access`='Admin'";
        $employee_result = mysqli_query($conn, $select_employee_query);

        while ($employee_row = mysqli_fetch_assoc($employee_result)) {
            echo "<option value='" . $employee_row['Login'] . "'>" . $employee_row['Login'] . "</option>";
        }
        ?>
    </select><br><br>

    Zmień hasło: <input type="password" name="new_password"><br><br>
    Zmień login: <input type="text" name="new_login"><br><br>

    <input type="submit" value="zapisz_zmiany">
</form>

            <!-- form szukający lotów -->
            <form method="post" action="look_for_flight.php">
               Znajdź lot o numerze:
               <input type="text" name="selected_flight" placeholder="Numer lotu" required><br>
               <input type="submit" name="wyszukaj_lot" value="Wyszukaj">
            </form>
	    <br/>
            <!-- Form pokazujący info pracowników -->
	       <form method="post" action="show_workers.php">
               <input type="submit" name="wyszukaj_pracownika" value="Pokaż informacje pracowników">
            </form>
            <br/>
            <!-- Form pokazujący info samolotów -->
	       <form method="post" action="show_planes.php">
               <input type="submit" name="wyszukaj_samolot" value="Pokaż informacje dostępnych samolotów">
            </form>
            <br/>

            <!-- form dodający pojazdy -->
            <form method="post" action="add_vehicle.php">
            Wybierz pojazd który chcesz dodać:
            <select name="selected_vehicle">
                <option>samolot</option>
            </select><br><br>
            <input type="text" name="name" placeholder="nazwa pojazdu"></input>
            <input type="text" name="amount_of_seats" placeholder="liczba miejsc"></input>
            <input type="text" name="id" placeholder="id samolotu"></input>
            <input type="submit" name="dodaj" value="dodaj">
            </form>

                    <!-- Form usuwający pojazdy -->
                    <form method="post" action="delete_vehicle.php">
            Wybierz pojazd do usunięcia:
            <select name="selected_vehicle">
        <?php
        $select_plane_query = "SELECT Plane_id FROM planes";
        $plane_result = mysqli_query($conn, $select_plane_query);

        while ($plane_row = mysqli_fetch_assoc($plane_result)) {
            echo "<option value='" . $plane_row['Plane_id'] . "'>" . $plane_row['Plane_id'] . "</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" name="usun" value="Usuń">
            </form>
			Wybierz lot którego status chcesz zmienić:
    <select name="selected_flight">
        <?php
        $select_flight_query = "SELECT Flight_id FROM flights";
        $flight_result = mysqli_query($conn, $select_flight_query);

        while ($flight_row = mysqli_fetch_assoc($flight_result)) {
            echo "<option value='" . $flight_row['Flight_id'] . "'>" . $flight_row['Flight_id'] . "</option>";
        }
        ?>
    </select><br><br>

    Zmień status: <select name="new_status">
        <option value="finished">zakończony</option>
        <option value="delayed">opóźniony</option>
        <option value="pending">oczekujący</option>
        <option value="cancelled">anulowany</option>
        <option value="ongoing">w trakcie</option>
    </select><br>

    <input type="submit" value="zapisz zmiany">
</form>

            <?php
            // Additional content for administrators

            echo '<form method="post" action="log_form.php"><input type="submit" value="Wyloguj"></form>';
            
        } elseif ($user_role === "Employee") {
            // Content visible for employees
            ?>
            <!-- Form szukający lotów -->
	    <form method="post" action="look_for_flight.php">
               Znajdź lot o numerze:
               <input type="text" name="selected_flight" placeholder="Numer lotu" required><br>
               <input type="submit" name="wyszukaj_lot" value="Wyszukaj">
            </form>
	    <br/>
            <!-- Form pokazujący info pracowników -->
	       <form method="post" action="show_workers.php">
               <input type="submit" name="wyszukaj_pracownika" value="Pokaż informacje pracowników">
            </form>
            <br/>
            <!-- Form pokazujący info samolotów -->
	       <form method="post" action="show_planes.php">
               <input type="submit" name="wyszukaj_samolot" value="Pokaż informacje dostępnych samolotów">
            </form>
            <br/>
            
            <form method="post" action="edit_flight.php">
    Wybierz lot którego status chcesz zmienić:
    <select name="selected_flight">
        <?php
        $select_flight_query = "SELECT Flight_id FROM flights";
        $flight_result = mysqli_query($conn, $select_flight_query);

        while ($flight_row = mysqli_fetch_assoc($flight_result)) {
            echo "<option value='" . $flight_row['Flight_id'] . "'>" . $flight_row['Flight_id'] . "</option>";
        }
        ?>
    </select><br><br>

    Zmień status: <select name="new_status">
        <option value="finished">zakończony</option>
        <option value="delayed">opóźniony</option>
        <option value="pending">oczekujący</option>
        <option value="cancelled">anulowany</option>
        <option value="ongoing">w trakcie</option>
    </select><br>

    <input type="submit" value="zapisz zmiany">
</form>





            <?php
            // Additional content for employees
            echo '<form method="post" action="log_form.php"><input type="submit" value="Wyloguj"></form>';
        }
    } else {
        echo "User role not found!";
    }
} else {
    echo "User ID not found in session!";
}
?>
           </div>
           <div id="footer">
           Kontakt: (przykładowe dane)
           </div>