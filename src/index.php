<?php
    // Functie: programma login OOP 
    // Auteur: Studentnaam

    // Initialisatie
    require_once 'config.php';
	require_once 'classes/User.php';
	$pdo = getPDO();
	$user = new User($pdo);
?>

<!DOCTYPE html>

<html lang="en">

<body>

	<h3>PDO Login and Registration</h3>
	<hr/>

	<h3>Welcome op de HOME-pagina!</h3>
	<br />

	<?php

	// Activeer de session
	session_start();

	// Indien Logout geklikt
	if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
		$user->logout();
	}

	// Check login session: staat de user in de session?
	if(!$user->isLoggedin()){
		// Alert not login
		echo "U bent niet ingelogd. Login in om verder te gaan.<br><br>";
		// Toon login button
		echo '<a href = "login_form.php">Login</a>';
	} else {
		
		// select userdata from database
		if (isset($_SESSION['username'])) {
			$user->getUser($_SESSION['username']);
		}
		
		// Print userdata
		echo "<h2>Het spel kan beginnen</h2>";
		echo "Je bent ingelogd met:<br/>";
		$user->showUser();
		echo "<br><br>";
		echo '<a href = "?logout=true">Logout</a>';
	}
	
	?>

</body>
</html>
