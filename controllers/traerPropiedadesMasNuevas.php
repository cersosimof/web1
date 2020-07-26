<?php
session_start();
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$connect = new ConnectDB();
$d = $connect->traerCuatroPropiedades();

output($d);
?>