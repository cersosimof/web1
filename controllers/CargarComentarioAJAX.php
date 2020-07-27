<?php

require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$idUsuario = $request->usuario;
$idPropiedad = $request->propiedad;
$mensaje = $request->mensaje;

$connect = new ConnectDB();
$d = $connect->insertarComentario($idUsuario, $idPropiedad, $mensaje);

echo $d;
