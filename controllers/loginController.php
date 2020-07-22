<?php
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$usuario = $request->usuario;
$clave = $request->clave;

$connect = new ConnectDB();
$persona = $connect->loguearUsuario($usuario, $clave);

if($persona===null){
    output(0, 201);
} else {
    session_start();
    $_SESSION["usuario"] = $persona["usuario"];
    output(1, 201);
}

