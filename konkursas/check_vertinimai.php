<?php 
$sql = "SELECT * FROM $vertintoju_kompetencijos WHERE vertintojas='".$user_id."' LIMIT 2";
$v_k = mysqli_query($dbc,$sql);
if(!$v_k){
    echo "Negauna result";
}
$elem = mysqli_fetch_assoc($v_k);
$pirmas = $elem["id"];
$komp1 = $elem["kompetencijos"];
$elem = mysqli_fetch_assoc($v_k);
$antras = $elem["id"];
$komp2 = $elem["kompetencijos"];

$sql = "SELECT * FROM $konkurso_vertintojai WHERE vertina=$pirmas AND konkursas='".$topic_id."'";
$k_v = mysqli_query($dbc,$sql);
if(!$k_v){
    echo "Negauna result";
}

if(mysqli_num_rows($k_v) > 0) {
    $elem = $k_v->fetch_assoc();
    $vertina = $elem["vertina"];

    $sql = "SELECT * FROM $kompetencijos WHERE id=$komp1";
    $k_v = mysqli_query($dbc,$sql);
    if(!$k_v){
        echo "Negauna result";
    }
    $elem = $k_v->fetch_assoc();
    $komp = $elem["name"];
} else {
    $sql = "SELECT * FROM $konkurso_vertintojai WHERE vertina=$antras AND konkursas='".$topic_id."'";
    $k_v = mysqli_query($dbc,$sql);
    if(!$k_v){
        echo "Negauna result";
    }
    if(mysqli_num_rows($k_v) > 0) {
        $elem = $k_v->fetch_assoc();
        $vertina = $elem["vertina"];
        
        $sql = "SELECT * FROM $kompetencijos WHERE id=$komp2";
        $k_v = mysqli_query($dbc,$sql);
        if(!$k_v){
            echo "Negauna result";
        }
        $elem = $k_v->fetch_assoc();
        $komp = $elem["name"];
    }
}
?>