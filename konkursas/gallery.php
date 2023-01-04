<?php 
include 'prisijunges.php';
if($level == 0) require('connection.php');
if(isset($_GET["uploaded"])) {
	$uploaded = 0;
} else {
	$uploaded = 1;
}
if(isset($_GET["saved"])) {
	$saved = 0;
} else {
	$saved = 1;
}
if(isset($_GET["vert"]) && $_GET["vert"] == 1) {
	$atsakingas = 1;
} else {
	$atsakingas = 0;
}

$topic = $_GET["topic"];

$puslapyje = 12;
$page = $_GET["page"];
$counter = ($page - 1) * $puslapyje;

$num_rows = 0;
$topic_id = 0;
if ($topic != "top10") {
	$sql = "SELECT * FROM $konkursas WHERE pavadinimas='".$topic."' LIMIT 1";
	$result = mysqli_query($dbc,$sql);
	if(!$result){
		echo "Negauna result";
	}
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		$k = $result->fetch_assoc();
		$topic_id = $k["id"];
		$sql = "SELECT pies.id, pies.pavadinimas, pies.komentaras, pies.autorius,
		 pies.balas, aut.name, aut.lastname FROM $piesiniai as pies
				INNER JOIN $vartotojai as aut
				ON pies.autorius = aut.id 
				WHERE konkursas=$topic_id";
		$result = mysqli_query($dbc,$sql);
		if(!$result){
			echo "Negauna result";
		}
		$num_rows = mysqli_num_rows($result);
	}
} else {
	$sql = "SELECT pies.id, pies.pavadinimas, pies.komentaras, pies.autorius, pies.balas, pies.konkursas,
			aut.name, aut.lastname, aut.date, konk.pavadinimas as temos_pavadinimas FROM $piesiniai as pies
		   INNER JOIN $vartotojai as aut
		   ON pies.autorius = aut.id
		   INNER JOIN $konkursas as konk
		   ON pies.konkursas = konk.id    
		   ORDER BY pies.balas DESC, aut.date DESC LIMIT 10";
	$result = mysqli_query($dbc,$sql);
	if(!$result){
		echo "Negauna result";
	}
	$num_rows = mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Konkursas "<?=ucwords($topic)?>"</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	</head>
	<body>
		<div class="jumbotron text-center w3-display-container">
			<a class="w3-display-topleft" href="index.php">
				<img src="icons/back.png" alt="Atgal" style="width:50px; height: 50px;">
			</a>
			<?php if ($topic != "top10") : ?>
				<h1>Konkursas "<?=ucwords($topic)?>"</h1>
				<p>Pežiūrėkite dalyvių piešinius, kurių tema - "<?=ucwords($topic)?>"</p>
			<?php else :?>
				<h1><?=ucwords($topic)?></h1>
				<p>Pežiūrėkite dalyvių piešinius, kurie pateko į "<?=ucwords($topic)?>"</p>
			<?php endif; ?>
		</div>
		<div class="content">

			<div class="container">
			  	<div class="row">

					<?php if ($num_rows > 0):
							for($i = 0; $i < $counter; $i++){ $row = mysqli_fetch_assoc($result);}
							for($i = $counter; $i < $num_rows; $i++):
								if ($i - $counter >= $puslapyje) break;
								$row = mysqli_fetch_assoc($result) ?>
								<div class="col-xm-12 col-sm-6 col-md-4 col-lg-3">
									<div class="w3-container w3-gray">
										<h1>Autorius: <?php echo $row['name']." ".$row['lastname']; ?></h1>
									</div>

									<a  href="<?php echo $row['pavadinimas']; ?>">
										<img class="w3-hover-shadow" src="<?php echo $row['pavadinimas']; ?>" alt="Italian Trulli" style="width:100%; height: 222px; object-fit: cover;" >
									</a>
									
									<div class="w3-container w3-light-gray" <?php if ($level == 5 && $atsakingas == 1 || $topic == "top10"): ?> style="height: 300px;" <?php else : ?> style="height: 200px;" <?php endif; ?>>
										<p style="padding-top: 10px;"><b> Komentaras:</b><br><?php  echo $row['komentaras']; ?> </p>
										<p> <b>Bendras balas:</b><br><?php  if(isset($row['balas'])) echo $row['balas']; else echo "Neįvertinta"; ?> </p>
										<?php 
										if ($level == 5 && $atsakingas == 1): 
											include 'check_vertinimai.php';
											$pies_id = $row["id"];
											$sql = "SELECT * FROM $vertinimai WHERE piesinys=$pies_id AND vertintojas=$vertina LIMIT 1";
											$vert = mysqli_query($dbc,$sql);
											if(!$vert){
												echo "Negauna result";
											}
											$update = 0;
											if(mysqli_num_rows($vert) > 0) {
												$update = 1;
												$yra = $vert->fetch_assoc();
											}	
										?>
											<form action="update.php?topic_id=<?=$topic_id?>&topic=<?=$topic?>&update=<?=$update?>&page=<?=$page?>" method="post">
												<label for="balas"><b>Pasirinkite balą</b></label>
												<br><select id="balas" name="balas" onchange="saugoti();">
													<?php $rodyti = "Neįvertinta"; if($update == 1){ $rodyti = $yra['balas'];} ?>
													<option value=""><?= $rodyti ?></option>
													<?php for($j = 1; $j <= 10; $j++) : ?>
														<option value="<?=$j?>"><?=$j?></option>
													<?php endfor; ?>
												</select>
												
												<input type="hidden" name="piesinys" id="piesinys" value="<?php echo $row['id']; ?>"/>
												<input name ="submit" type="submit" value="Išsaugoti"/>
											</form>
									<?php endif; 
									if ($topic == "top10"):?>
										<p> <b>Tema: <?=ucwords($row["temos_pavadinimas"]) ?></b><br>
										<p> <b>Gimimo data: <?=ucwords($row["date"]) ?></b><br>
									<?php endif; ?>
									</div>
									<br>
								</div>
						<?php endfor; ?>
					<?php else: echo "Piešinių nėra."; 
						endif;?>

				</div>
			</div>

			<footer class="w3-container w3-light-gray w3-center">
				<?php if ($page != 1):
					$buves = $page - 1;
					$link = "gallery.php?topic=".$topic."&page=".$buves;
					if ($level == 5 && $atsakingas == 1) { $link = $link."&vert=1"; }?>
					<a href="<?=$link ?>" class="w3-button">&laquo;</a>
					<a href="<?=$link ?>" class="w3-button"> <?= $buves ?> </a>
				<?php endif; ?>
			
				<a class="w3-button w3-green"> <?= $page ?> </a>
				
				<?php if (($num_rows - $counter) > $puslapyje):
					$sekantis = $page + 1;
					$link = "gallery.php?topic=".$topic."&page=".$sekantis;
					if ($level == 5 && $atsakingas == 1) { $link = $link."&vert=1"; }?>
					<a href="<?=$link ?>" class="w3-button"> <?= $sekantis ?> </a>
					<a href="<?=$link ?>" class="w3-button">»</a>
				<?php endif; ?>	
			</footer>

		</div>

		<?php if ($uploaded === 0): ?>
		<script> 
			Swal.fire({
			title: 'Įkėlimas sėkmingas!',
			icon: 'success',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "gallery.php?topic=<?=$topic?>&page=<?= $page ?>";
				}
			}) 
		</script>
		<?php endif; ?>

		<?php if ($saved === 0): ?>
		<script> 
			Swal.fire({
			title: 'Išsaugota sėkmingai!',
			icon: 'success',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "gallery.php?topic=<?=$topic?>&page=<?= $page ?>&vert=1";
				}
			}) 
		</script>
		<?php endif; ?>
	</body>
</html>
