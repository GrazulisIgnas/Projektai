<?php
require('connection.php');
$sql = sprintf("SELECT * FROM $vartotojai
				WHERE email='%s'",
			  	$dbc->real_escape_string($_GET["email"]));
$result = $dbc->query($sql);
$is_available = $result->num_rows === 0;

header("Content-Type: application/json");
echo json_encode(["available" => $is_available]);
?>