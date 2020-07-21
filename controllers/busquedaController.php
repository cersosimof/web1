<?php
session_start();
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$operacion = $request->pOperacion;
$provincia = $request->pProvincia;
$partido = $request->pPartido;
$orden = $request->pOrden;

$connect = new ConnectDB();
$d = $connect->traerTodasLasPropiedades($operacion, $partido, $orden);

output($d);
?>