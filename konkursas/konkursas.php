<?php
include 'prisijunges.php';
if(!isset($level) || $level != 9) {
    echo "NE ADMINISTRATORIUS";
    die();
}

$sql = "SELECT * FROM $kompetencijos";
$result = mysqli_query($dbc,$sql);

if(!$result){
    echo "Negauna result";
}
$num_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="disable.js"></script>
        <link rel="stylesheet" href="style_form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
    </head>
    <body>
        <form name="theForm" action="konkursas_upload.php" method="post" required>
            <div class="container">
                <h1>Konkurso kūrimas</h1>
                <p>Užpildykite visus laukus</p>
                <hr>

                <label class="required" for="name"><b>Pavadinimas</b></label>
                <input type="text" placeholder="Įveskite pavadinimą" name="name" id="name" required>

                <hr><p>Tas pats vertintojas gali būti priskirtas tik vienai kategorijai!</p>
                <script> 
                    const arr = [];
                    const op = []; 
                </script>
                <?php $used = array();
                    while($row = mysqli_fetch_assoc($result)) : 
                        $komp_id = $row["id"];
                        $komp_name = $row["name"];?>
                        <label class="required" for="<?=$komp_name?>"><b>Pasirinkite vertintoją atsakingą už "<?=$komp_name?>"</b></label>
                        <br><select id="<?=$komp_id?>" name="<?=$komp_name?>" onchange="disable(arr, op, this.value, this.id, <?=$num_rows?> );">
                        <option value="-1" selected="selected" disabled >Pasirinkite vertintoją</option>
                        <?php $sql = "SELECT v.id AS vert_id, v.name AS vert_name, v.lastname AS vert_lastname, v_k.id AS vert_komp_id,  v_k.kompetencijos AS komp_id
                                      FROM $vartotojai AS v 
                                      INNER JOIN $vertintoju_kompetencijos AS v_k
                                      ON v_k.vertintojas = v.id
                                      WHERE v.privilegijos = 5 ";

                            $result_vert = mysqli_query($dbc,$sql);
                            if(!$result_vert){
                                echo "Negauna result";
                            }
                            while($data = mysqli_fetch_assoc($result_vert)) : 
                                if ($data["komp_id"] == $komp_id):?>
                                    <?php echo "<option value=".$data["vert_id"].">".ucwords($data["vert_name"]." ".$data["vert_lastname"])."</option>"; ?>
                                    
                        <?php endif; 
                        endwhile; ?>
                    </select><br>
                <?php endwhile; ?>

                <hr>
				
				<input name ="submit" type="submit" class="registerbtn" value="Kurti"/>
            </div>
        </form>

        <?php if (isset($_GET["isSet"])): ?>
		<script> 
			Swal.fire({
			title: 'Ne visi laukai užpildyti!',
			icon: 'error',
			confirmButtonText: 'OK',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "konkursas.php";
				}
			}) 
		</script>
		<?php endif; ?>
    </body>
</html>