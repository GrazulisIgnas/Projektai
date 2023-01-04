<?php 
include 'prisijunges.php';
if($level == 0) require('connection.php');
$sql = "SELECT * FROM $konkursas";
$result = $dbc->query($sql);
if(!$result){
	echo "Negauna result";
}
$num_rows = mysqli_num_rows($result);
?>

<html>
    <head>
        <link rel="stylesheet" href="styles.css">
		<meta charset="utf-8">
    </head>
    <body>
        <div class="up">
            <a href="index.php" class="glow_up">Piešinių konkursas</a>
        </div>

        <div class="eile">
            <div class="stulpelis kaire">
                <div class="topic">
                    <h2>Konkursai</h2>
                    <?php for($i = 0; $i < $num_rows; $i++) :
						$data = mysqli_fetch_assoc($result) ?>
                         <?php if ($level == 5) : 
                            $topic_id = $data["id"];
                            $komp = NUll;
                            include 'check_vertinimai.php';
                                if (isset($komp)): ?>
                                <a href="gallery.php?topic=<?=$data["pavadinimas"]?>&page=1&vert=1"><?=ucwords($data["pavadinimas"])?></a>
                                <p> esate atsakingas už <?= ucwords($komp)?> vertinimą </p>
                                <?php else : ?>
                                    <a href="gallery.php?topic=<?=$data["pavadinimas"]?>&page=1&vert=0"><?=ucwords($data["pavadinimas"])?></a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="gallery.php?topic=<?=$data["pavadinimas"]?>&page=1"><?=ucwords($data["pavadinimas"])?></a>
                            <?php endif; ?>
                    <?php  endfor; ?>
                    <br><hr><br>
                    <h2>Geriausi piešiniai</h2>
                    <a href="gallery.php?topic=top10&page=1">TOP 10</a>
                </div>
            </div>
            <div class="stulpelis vidurys">
                <h2 class="headeris">Kaip dalyvauti?</h2><br>
                <h2> Užsiregistravęs ir prisijungęs prie savo paskyros galėsi įkelti piešinį.</h2><br>
                <h2>Turėsi pasirinkti vieną iš konkurso temų.</h2><br> 
                <h2>Konkursų piešinius vertina pagal tam tikras kategorijas. </h2><br>
                <h2>Kai vertintojai įvertins piešinį, bus matomas tik bendras balas.</h2><br><hr><br>

                <h2 class="headeris">Kaip vertinti?</h2><br>
                <h2> Susiek su administratoriumi šiuo paštu <em>igngra3@ktu.edu</em></h2><br>
                <h2>Turėsi nurodyti savo duomenis ir iki dviejų kompetencijų, kuriose gali vertinti.</h2><br> 
                <h2>Paskelbus konkursą administratorius priskirs prie tam tikros kompetencijos vieną iš vertintojų. </h2><br>
                <h2>Atsidarius konkurso galeriją matysite mygtuką <em>VERTINTI</em>.</h2><br>

            </div>
            <div class="stulpelis desine">
				<?php if (isset($user)): ?>
					<h3>Prisijungęs kaip</h3>
					<hr><p class="cursive"><?= htmlspecialchars($name) ?></p><hr><br>
					<a href="atsijungti.php">Atsijungti</a>
					<?php if ($level == 1): ?>
						<br><hr><h3>Dalyvis</h3><hr><br>
						<a href="upload_form.php">Įkelti piešinį</a>
						<br><hr>
					<?php elseif ($level == 5): ?> 
						<br><hr><h3>Vertintojas</h3><hr><br>
						<br><hr>
					<?php elseif ($level == 9): ?> 
						<br><hr><h3>Admin</h3><hr><br>
						<a href="registracija.php">Registruoti vertintoją</a>
                        <a href="konkursas.php">Kurti konkursą</a>
						<br><hr>
					<?php endif; ?>
				<?php else: ?>
					<a href="registracija.php">Registracija</a>
					<a href="prisijungti.php">Prisijungimas</a>
				<?php endif; ?>
            </div>
        </div>
        <div class="bottom">
            <h4>Autorius: IFB-0 grupės studentas Ignas Gražulis</h4>
        </div>
    </body>
</html>