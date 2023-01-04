<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
	
	require('connection.php');
	if (isset($_POST['email']) && isset($_POST['psw'])) {
		$email = $_POST['email'];
		$psw = $_POST['psw'];

		$sql = "SELECT * FROM $vartotojai WHERE email='".$email."' LIMIT 1";

		$result = $dbc->query($sql);
		$user = $result->fetch_assoc();

		if($result -> num_rows == 1 && password_verify($psw, $user["psw"])){
			session_start();
			session_regenerate_id();
			$_SESSION["user_id"] = $user["id"];
			header("Location: index.php");
			exit();
		} else {
			$is_invalid = true;
		}
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta charset="utf-8">
    <link rel="stylesheet" href="style_form.css">
</head>
<body>

<form method="post" required>
  <div class="container">
    <h1>Prisijungimas</h1>
    <hr>
    <?php if($is_invalid): ?>
	  	<em>Neteisingi prisijungimo duomenys</em><br><br>
	<?php endif;?>
    <label class="required" for="email"><b>Elektroninis paštas</b></label>
    <input type="text" placeholder="Įveskite El. paštą" name="email" id="email"
    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
    title="Elektroninis paštas turi būt 'vardas@el.pastas.kazkas' "
		   value = "<?=htmlspecialchars($_POST["email"] ?? "") ?>" required>

    <label class="required" for="psw"><b>Slaptažodis</b></label>
    <input type="password" placeholder="Įveskite slaptažodį" name="psw" id="psw" required>

    <input type="submit" class="registerbtn" value="Prisijungti"/>
  </div>
  <div class="container signin">
    <p>Neturite paskyros? <a href="registracija.php">Registracija</a>.</p>
  </div>
</form>

</body>
</html>
