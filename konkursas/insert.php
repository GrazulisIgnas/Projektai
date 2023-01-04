<?php
include 'prisijunges.php';
if($level == 0) require('connection.php');
if($_POST !=null){
	$email = $_POST['email'];
	$psw = $_POST['psw'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$date = $_POST['date'];
	$psw_hash = password_hash($psw, PASSWORD_DEFAULT);
	
	if ($level == 9) {
		$sql = "INSERT INTO $vartotojai (email, psw, name, lastname, date, privilegijos ) 
			VALUES ('$email', '$psw_hash', '$name', '$lastname', '$date', 5 )";
		if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
		
		$sql = "SELECT id FROM $vartotojai WHERE email='".$email."' LIMIT 1";
		$result = $dbc->query($sql);
		$vert = $result->fetch_assoc();
		$id = $vert["id"];

		$komp1 = $_POST['komp_1'];
		$sql = "INSERT INTO $vertintoju_kompetencijos (vertintojas, kompetencijos) 
		VALUES ('$id', '$komp1')";
		if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));

		$komp2 = $_POST['komp_2'];
		$sql = "INSERT INTO $vertintoju_kompetencijos (vertintojas, kompetencijos) 
		VALUES ('$id', '$komp2')";
	} elseif ($level == 0) {
		$sql = "INSERT INTO $vartotojai (email, psw, name, lastname, date ) 
			VALUES ('$email', '$psw_hash', '$name', '$lastname', '$date' )";
		
	}

	if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
    mysqli_close($dbc);
	if ($level == 9) {
		header("Location: index.php");
	} elseif ($level == 0) {
		header("Location: prisijungti.php");
		//echo "irasiau";
	}
	
    exit();
}
?>