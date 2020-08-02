<?php
require_once("../models/ConnectDB.php");
require_once("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$id = $request->id;

$connect = new ConnectDB();
$d = $connect->eliminarUsuarioADM($id);