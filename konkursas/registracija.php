<?php
include 'prisijunges.php';
if($level == 0) $level = 1;
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style_form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
        <script src="registracija.js"></script>
        <script src="disable.js"></script>
    </head>
    <body>
        <form name="theForm" action="insert.php" method="post" required>
            <div class="container">
				<?php if ($level == 9): ?>
                	<h1>Vertintojo registracija</h1>
				<?php else: ?>
					<h1>Dalyvio registracija</h1>
				<?php endif; ?>
                <p>Užpildykite visus laukus</p>
                <hr>

                <label class="required" for="email"><b>Elektroninis paštas</b></label>
                <input type="text" placeholder="Įveskite El. paštą" name="email" id="email"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                        title="Elektroninis paštas turi būt 'vardas@el.pastas.kazkas' " required>

                <label class="required" for="psw"><b>Slaptažodis</b></label>
                <input type="password" placeholder="Įveskite slaptažodį" name="psw" id="psw" 
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                        title="Slaptažodis turi būt sudarytas iš bent vieno skaitmens,
                                        mažosios ir didžiosios raidės bei turi būt sudarytas bent iš 8 simbolių" required>

                <label class="required" for="psw-repeat"><b>Pakartotinis slaptažodis</b></label>
                <input type="password" placeholder="Pakartokite slaptažodį" name="psw-repeat" id="psw-repeat" required>

                <label class="required" for="name"><b>Vardas</b></label>
                <input type="text" placeholder="Įveskite vardą" name="name" id="name" required>

                <label class="required" for="lastname"><b>Pavardė</b></label>
                <input type="text" placeholder="Įveskite pavardę" name="lastname" id="lastname" required>

                <label class="required" for="date"><b>Gimimo data</b></label><br>
                <input type="date" placeholder="Įveskite pavardę" name="date" id="date" required>
                
                <hr>
				<?php if ($level != 9): ?>
					<p>Sukuriant paskyrą sutinkama, jog jūsų duomenys būtų viešinami.</p>
				<?php else: ?>
                    <script> 
                        const arr = [];
                        const op = []; 
                    </script>
                    <?php for ($i = 1; $i < 3; $i++) : 
                        $sql = "SELECT * FROM $kompetencijos";
                        $komp = mysqli_query($dbc,$sql);
                        $num_rows = mysqli_num_rows($komp);?>

                        <label class="required" for="<?=$i?>"><b>Pasirinkite už kokią <?=$i?> kompetenciją bus atsakingas šis vertintojas</b></label>
                        <select id="<?=$i?>" name="komp_<?=$i?>" onchange="disable(arr, op, this.value, this.id, 2 );">
                            <option value="-1" selected="selected" disabled >Pasirinkite kompetenciją</option>
                            <?php while($data = mysqli_fetch_assoc($komp)) : 
                                    echo "<option value=".$data["id"].">".ucwords($data["name"])."</option>";  
                                endwhile; ?>
                        </select>
                    <?php endfor; ?><hr>
                <?php endif; ?>
				
				<input name ="sumbit" type="submit" class="registerbtn" 
					   onClick="return validation(event); return false" value="Registruotis"/>
            </div>
            
			<?php if ($level != 9): ?>
				<div class="container signin">
                	<p>Jau turite paskyrą? <a href="prisijungti.php">Prisijungti</a>.</p>
            	</div>
			<?php endif; ?>
        </form>
    </body>
</html>
