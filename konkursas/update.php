<?php
if($_POST !=null){
    include 'prisijunges.php';
	$balas = $_POST['balas'];
    $piesinio_id = $_POST['piesinys'];
    $topic_id = $_GET["topic_id"];
    $topic_name = $_GET["topic"];
    $update = $_GET["update"];
    $page = $_GET["page"];
    include 'check_vertinimai.php';

    if ($update != 1){
        $sql = "INSERT INTO $vertinimai (piesinys, vertintojas, balas) 
                VALUES ('$piesinio_id', '$vertina', '$balas' )";
        if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
    } else {
        $sql = "UPDATE $vertinimai SET balas = $balas WHERE piesinys = $piesinio_id AND vertintojas = $vertina";
        if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
    }
    // tikrina kiek kompetenciju yra viso (tiek turi but vertinimu)
    $sql = "SELECT * FROM $kompetencijos";
    $komp = mysqli_query($dbc,$sql);
    if(!$komp){
        echo "Negauna result";
    }
    $komp_num_rows = mysqli_num_rows($komp);
    // tikrina kiek jau vertinimu turi piesinys
    $sql = "SELECT * FROM $vertinimai WHERE piesinys=".$piesinio_id;
    $vert = mysqli_query($dbc,$sql);
    if(!$vert){
        echo "Negauna result";
    }
    $vert_num_rows = mysqli_num_rows($vert);
    // jei piesini ivertino visi tai update bendra bala

    if ($komp_num_rows == $vert_num_rows){
        $bendras = 0;
        while ($row = mysqli_fetch_assoc($vert)){
            $bendras = $bendras + $row['balas'];
        }
        $bendras = $bendras / $vert_num_rows;
        $sql = "UPDATE $piesiniai SET balas = $bendras WHERE id = $piesinio_id";
        if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
    }
    

    mysqli_close($dbc);
    header("Location: gallery.php?topic=".$topic_name."&page=".$page."&vert=1&saved=0");
    exit();
}
?>