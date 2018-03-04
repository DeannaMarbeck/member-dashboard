<?php

include('../includes/database_config.php');
include('../includes/database_connection.php');

// Initialise variables
$id = '';
$query = '';
$display = '';
$delete_completed = false;

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
			// Display data for the user
			$query = "DELETE FROM users WHERE id='$id';";
			$result = mysqli_query($db_connection, $query);
			if ($result){
				if (mysqli_affected_rows($db_connection) == 1){
					// Success message here
					$delete_completed = true;
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
		<h2>Delete member</h2>
		<?php if ($delete_completed == true) {
			echo '<h2>Member id ' . $id . ' deleted</h2>';
		} ?>
		<p><a href="../members.php">Show all members here</a></p>
	</section>

</body>
</html>