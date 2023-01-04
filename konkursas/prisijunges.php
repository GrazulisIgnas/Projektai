<?php
session_start();
if (isset($_SESSION["user_id"])) {
	require('connection.php');
	
	$sql = "SELECT * FROM $vartotojai WHERE id='".$_SESSION["user_id"]."' LIMIT 1";
	$result = $dbc->query($sql);
	$user = $result->fetch_assoc();
	$level = $user["privilegijos"];
	$name = $user["name"];
	$user_id = $user["id"];
} else {
	$level = 0;
}
?>