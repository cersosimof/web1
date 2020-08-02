<?php
require_once("../models/ConnectDB.php");
require_once("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$id = $request->id;
$operacion = $request->operacion;
$provincia = $request->provincia;
$partido = $request->partido;
$tipo = $request->tipo;
$direccion = $request->direccion;
$precio = $request->precio;
$tamano = $request->tamano;
$descripcion = $request->descripcion;
$foto = $request->foto;

$connect = new ConnectDB();
$x = $connect->modificarPropiedadADM($id, $operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $foto);


