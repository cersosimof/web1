<?php

require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$idPropiedad = $request->pPropiedad;

$connect = new ConnectDB();
$d = $connect->traerMensajes($idPropiedad);

output($d);
