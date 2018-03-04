<?php

include('../includes/database_config.php');
include('../includes/database_connection.php');

// Initialise variables
$id = '';
$query = '';
$display = '';

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
			$row = mysqli_fetch_assoc($result);
			$display = '<p class="results"> <span class="field"> '. $row["name"] . '</span>';
			$display .= '<span class="field">' . $row["email"] . '</span>';
			$display .= '</p>';
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
		<h2>View member</h2>
		<p><?php echo $display; ?></p>
		<p><?php echo '<a href="edit.php?id=' . $id .'">Edit member</a>'; ?></p> 
		<a class="footer" href="../members.php">Show all members</a>
	</section>

</body>
</html>