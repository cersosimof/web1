<?php
session_start();
require_once("../models/ConnectDB.php");
$connect = new ConnectDB();
$partidos = $connect->traerPartidos();


require_once("../views/home.php");

