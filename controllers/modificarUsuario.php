<?php
require_once("../models/ConnectDB.php");
require_once("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$id = $request->id;
$nombre = $request->nombre;
$apellido = $request->apellido;
$usuario = $request->usuario;
$correo = $request->correo;
$c1 = $request->claveUno;

//echo $id . " " . $nombre . " " . $apellido . " " . $usuario . " " . $correo . " " . $c1;

$connect = new ConnectDB();
$x = $connect->modificarUsuarioADM($id, $nombre, $apellido, $usuario, $correo, $c1);


