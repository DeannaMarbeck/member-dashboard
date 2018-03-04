<?php
$db_connection = new mysqli($db_server, $db_username, $db_password, $db_database);
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
    echo 'The database connection failed';
}
?> 