<?php

include('../includes/database_config.php');
include('../includes/database_connection.php');

// Initialise variables
$query = '';
$id = '';
$form_completed = false;

// Get the id from the url query string
if ($_GET) {
	$id = $_GET['id'];

	// Get record for id from database
	$query = "SELECT * FROM users WHERE id='$id';";
	$result = mysqli_query($db_connection, $query);
	if ($result){
		if (mysqli_num_rows($result) != 1) {
			echo 'There was a problem matching the id in the database';
		} else {
			// Get the existing data for the user to display their name in the form
			$row = mysqli_fetch_assoc($result);
		}
	} else {
		echo "There was a problem with the database query";
	}
}

if ($_POST) {
	// Get data from the form
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$id = $_POST['post_id'];

	// Clean input
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$clean_name = mysqli_real_escape_string($db_connection, $name);
	$clean_email = mysqli_real_escape_string($db_connection, $email);
	$clean_password = mysqli_real_escape_string($db_connection, $hashed_password);

	// Write back to database
	$query = "UPDATE users SET name='$clean_name', email='$clean_email', password='$clean_password' WHERE id='$id';";
	$result = mysqli_query($db_connection, $query);
	if ($result){
		if (mysqli_affected_rows($db_connection) == 1){
			// Success
			$form_completed = true;
		} else {
			echo "There was a problem adding this record to the database";
		}
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
		<?php if ($form_completed == true) {
			echo '<h2>Thank you, edit completed</h2>';
		} else {
			?>
			<h2>Edit data for <?php echo $row['name']; ?></h2>

			<form action="edit.php" method="post">
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
					<p id="validation" class="validation"></p>
				</div>
				<input type="hidden" name="post_id" value="<?php echo $id; ?>" />
				<div>
					<button type="submit" id="submit">Update member</button>
				</div>
			</form>

		<?php } ?>
		<a class="footer" href="../members.php">Show all members</a>
	</section>
	<script type="text/javascript" src="../js/validation.js"></script>

</body>
</html>