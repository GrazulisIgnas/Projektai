<?php
$server = "localhost";
$db = "projektas";
$useris = "root";
$password = "";
$vartotojai = "vartotojai";
$piesiniai = "piesiniai";
$konkursas = "konkursas";
$konkurso_vertintojai = "konkurso_vertintojai";
$vertintoju_kompetencijos = "vertintoju_kompetencijos";
$vertinimai = "vertinimai";
$kompetencijos = "kompetencijos";
// prisijungimas prie DB
$dbc=mysqli_connect($server,$useris,$password, $db);
if(!$dbc){ die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc)); }
?>