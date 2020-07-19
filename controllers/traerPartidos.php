<?php

require_once("../models/ConnectDB.php");
$connect = new ConnectDB();
$partidos = $connect->traerPartidos();

//VER DONDE METER ESTA FUNCION
function output($val, $headerStatus=200) {
    header(' ', true, $headerStatus);
    header('Content-Type: application/json');
    print json_encode($val);
    die;
}

output($partidos);

