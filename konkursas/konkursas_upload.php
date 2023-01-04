<?php
if(isset($_POST["submit"])) {
    require('connection.php');

    $sql = "SELECT * FROM $kompetencijos";
    $komp = mysqli_query($dbc,$sql);
    if(!$kompetencijos){
        echo "Negauna result";
    }
    while($row = mysqli_fetch_assoc($komp)){
        $komp_name = $row["name"];
        if (!isset($_POST["$komp_name"])){
            header("Location: konkursas.php?isSet=0");
            exit();
        }   
    }
    $name = $_POST['name'];
    $sql = "INSERT INTO $konkursas (pavadinimas ) VALUES ('$name')";
    if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));

    $sql = "SELECT id FROM $konkursas WHERE pavadinimas='".$name."' LIMIT 1";
    $result = $dbc->query($sql);
    $konk = $result->fetch_assoc();
    $konk_id = $konk["id"];
    mkdir("uploads/".$name, 0777);

    $sql = "SELECT * FROM $kompetencijos";
    $komp = mysqli_query($dbc,$sql);
    if(!$kompetencijos){
        echo "Negauna result";
    }
    while($row = mysqli_fetch_assoc($komp)){
        $komp_id = $row["id"];
        $komp_name = $row["name"];
        $vert_id = $_POST["$komp_name"];

        $sql = "SELECT id FROM $vertintoju_kompetencijos WHERE vertintojas=".$vert_id." AND kompetencijos=".$komp_id." LIMIT 1";
        $result = $dbc->query($sql);
        $vert_komp = $result->fetch_assoc();
        $vert_komp_id = $vert_komp["id"];

        $sql = "INSERT INTO $konkurso_vertintojai (konkursas, vertina) 
                VALUES ('$konk_id', '$vert_komp_id')";
        if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));  
    }
    mysqli_close($dbc);
}
header("Location: index.php");
?>