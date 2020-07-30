<?php
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$usuario = $request->usuario;
$clave = md5($request->clave);

$connect = new ConnectDB();
$persona = $connect->loguearUsuario($usuario, $clave);

if($persona===null){
    output(0, 201);
} else {
    if($persona["usuario"] == "cersosimof"){
        session_start();
        $_SESSION["usuario"] = $persona["usuario"];
        $obj = (object) array('idd' => '123', 'ruta' => 'Administrador.php');
        output($obj, 201);
    } else {
        session_start();
        $_SESSION["usuario"] = $persona["usuario"];
        output(1, 201);
    }

}

