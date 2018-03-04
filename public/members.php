<?php

include('includes/database_config.php');
include('includes/database_connection.php');

// Initialise variables
$query = '';
$result = '';
$db_server = "localhost";
$db_username = "root";
$db_password = "root";
$db_database = "scotchbox";

// Print results
function print_member($row) {
	$display = '<p class="results"> <span class="field"> '. $row["name"] . '</span>';
	$display .= '<span class="field">' . $row["email"] . '</span>';
	$display .= '<span class="field"><a href="/members/view.php?id=' . $row["id"] . '">View member</a></span>';
	$display .= '<span class="red"><a href="/members/delete.php?id=' . $row["id"] . '">Delete member</a></span></p>';
	echo $display;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>All members</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<section class="container">
		<h1>Fintastic member database</h1>
		<h2>All members</h2>
		<?php
		// Get all users from database
		$query = "SELECT * FROM users";
		$result = mysqli_query($db_connection, $query);

		if (mysqli_num_rows($result) >= 1) {
			while ($row = $result->fetch_assoc()) {
				// If there is 1 or more members, display them
				print_member($row);
			} 
			$result->free();
		} else {
			echo "The database query didn't work";
		}
		?>
		<a class="footer" href="members/create.php">Create a new member</a>
	</section>

</body>
</html>
