<?php
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$producto = $request->productoP;
$id = $request->idP;

if($producto == 1) {
    $connect = new ConnectDB();
    $d = $connect->traerUnaPropiedadADM($id);

    output($d);
} else if ($producto == 2) {
    $connect = new ConnectDB();
    $d = $connect->traerUnUsuarioADM($id);
    output($d);
}




