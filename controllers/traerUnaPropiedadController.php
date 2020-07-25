<?php

require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$connect = new ConnectDB();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$propiedad = $request->pPropiedad;

$propiedad = $connect->traerUnaPropiedad($propiedad);

output($propiedad);


