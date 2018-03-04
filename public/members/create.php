<?php

include('../includes/database_config.php');
include('../includes/database_connection.php');

// Initialise variables
$email = '';
$name = '';
$password = '';
$query = '';

if ($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Clean input
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$clean_name = mysqli_real_escape_string($db_connection, $name);
	$clean_email = mysqli_real_escape_string($db_connection, $email);
	$clean_password = mysqli_real_escape_string($db_connection, $hashed_password);

	// Check email doesn't exist
	$query = "SELECT * FROM users WHERE email='$email';";
	$result = mysqli_query($db_connection, $query);
	if ($result){
		if (mysqli_num_rows($result) >= 1) {
			echo 'This email address already exists.  Have you already entered this person?';
		} else {

			// Add user to database
			$query = "INSERT INTO users (name, email, password) VALUES ('$clean_name', '$clean_email', '$clean_password');";
			$result = mysqli_query($db_connection, $query);
			if ($result){
				if (mysqli_affected_rows($db_connection) == 1){
					// Success message here
				} else {
					echo "There was a problem adding this record to the database";
				}
			}
		}
	} else {
		echo "There was a problem with the database query";
	}
}

?>


<!DOCTYPE html>
<html lang="en-gb">
<head>
	<title>Create user</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
	<section class="container">
		<h1>Fintastic member database</h1>
		<h2>Create new member</h2>

		<form action="create.php" method="post">
		<div>
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="" /> 
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="" /> 
		</div>
		<div>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" /> 
			<p id="validation"></p>
		</div>
		<div>
			<button type="submit" id="submit">Create member</button>
		</div>
		</form>

		<a href="../members.php">Show all members</a>
	</section>
<script type="text/javascript" src="../js/validation.js"></script>
</body>
</html>