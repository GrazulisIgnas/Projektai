<?php
include 'prisijunges.php';
if(isset($_POST["submit"])) {
	$id = $user["id"];
	$file = $_FILES["file"];
	$fileName = $_FILES["file"]["name"];
	$fileTmpName = $_FILES["file"]["tmp_name"];
	$fileSize = $_FILES["file"]["size"];
	$fileError = $_FILES["file"]["error"];
	$fileType = $_FILES["file"]["type"];
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg', 'jpeg', 'png');
	
	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0){
			if ($fileSize < 3000000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$topic = $_POST["topic"];
				$sql = "SELECT * FROM $konkursas WHERE id='".$topic."' LIMIT 1";
				$result = mysqli_query($dbc,$sql);
				if(!$result){
					echo "Negauna result";
				}
				$k = $result->fetch_assoc();
				$topic_name = $k["pavadinimas"];

				$fileDestination = 'uploads/'.$topic_name.'/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				
				require('connection.php');
				
				$comment = $_POST["comment"];
				$sql = "INSERT INTO $piesiniai (autorius, pavadinimas, konkursas, komentaras) 
						VALUES ('$id', '$fileDestination', '$topic', '$comment' )";
				if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
				mysqli_close($dbc);
				header("Location: gallery.php?topic=".$topic_name."&page=1&uploaded=0");
				exit();
				
				//header("Location: index.php?uploadsuccess");
			} else {
				echo "Failas yra per didelis.";
				header("Location: upload_form.php?error_size=0");
			}
		} else {
			echo "Atsiprašome, įvyko klaida įkeliant jūsų failą.";
			header("Location: upload_form.php?error_save=0");
		}
	} else {
		echo "Tik JPG, JPEG ir PNG failai yra leidžiami.";
		header("Location: upload_form.php?error_format=0");
	}
} else {
	echo "Ne užpildyta forma";
	header("Location: upload_form.php?error_fill=0");
}
?>