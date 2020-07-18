<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$usuario = $request->usuario;
$clave = $request->clave;

function output($val, $headerStatus = 200){
    header(' ', true, $headerStatus);
    header('Content-Type: application/json');
    print json_encode($val);
    die;
}

require_once("../models/ConnectDB.php");
    $connect = new ConnectDB();
    $persona = $connect->loguearUsuario($usuario, $clave);

    if($persona===null){
        output(0, 201);
    } else {
        session_start();
        $_SESSION["usuario"] = $persona["usuario"];
        output(1, 201);

}

