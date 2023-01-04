<?php 
include 'prisijunges.php';
if ($level != 1) {
	echo "Piešinius kelti gali tik Registruotas Dalyvis.";
	die();
}
$sql = "SELECT * FROM $konkursas";
$result = $dbc->query($sql);
$num_rows = mysqli_num_rows($result);
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
		

		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="container">
				<h1><?= htmlspecialchars($name) ?> Piešinių įkėlimas<hr>

				<label class="required" for="topic"><b>Pasirinkite konkursą</b></label>
				<br><select id="topic" name="topic">
					<?php for($i = 0; $i < $num_rows; $i++) :
						$data = mysqli_fetch_assoc($result) ?>
						 <option value="<?=$data["id"]?>"><?=ucwords($data["pavadinimas"])?></option>
					<?php endfor; ?>
				</select><br>
				
				<label class="required" for="file"><b>Įkelkite piešinio nuotrauką (tinka tik JPG, JPEG arba PNG formatai)</b></label>
				<input type="file" name="file" id="file">
				
				<label class="required" for="comment"><b>Komentarai</b></label>
                <input type="text" placeholder="Parašykite komentarą" name="comment" id="comment" required>
				
				<input name ="submit" type="submit" class="registerbtn" value="Įkelti"/>
			</div>
		</form>
		
		<?php if (isset($_GET["error_size"])): ?>
		<script> 
			Swal.fire({
			title: 'Failas per didelis (leidžiamas dydis iki 3MB)!',
			icon: 'error',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "upload_form.php";
				}
			}) 
		</script>
		<?php endif; ?>

		<?php if (isset($_GET["error_save"])): ?>
		<script> 
			Swal.fire({
			title: 'Klaida įkeliant failą!',
			icon: 'error',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "upload_form.php";
				}
			}) 
		</script>
		<?php endif; ?>

		<?php if (isset($_GET["error_format"])): ?>
		<script> 
			Swal.fire({
			title: 'Netinkamas failo formatas!',
			icon: 'error',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "upload_form.php";
				}
			}) 
		</script>
		<?php endif; ?>

		<?php if (isset($_GET["error_fill"])): ?>
		<script> 
			Swal.fire({
			title: 'Ne visi laukai užpildyti!',
			icon: 'error',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "upload_form.php";
				}
			}) 
		</script>
		<?php endif; ?>
	</body>
</html>
