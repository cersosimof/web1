<?php
session_start();
require_once("../models/ConnectDB.php");

$connect = new ConnectDB();

if(isset($_SESSION["usuario"])){

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $operacion = $request->operacion;
    $provincia = $request->provincia;
    $partido = $request->partido;
    $tipo = $request->tipo;
    $direccion = $request->direccion;
    $precio = $request->precio;
    $tamano = $request->tamano;
    $descripcion = $request->descripcion;
    $usuario = $_SESSION["usuario"];

$altaPropiedad = $connect->insertarNuevaPropiedad($operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $usuario);

//print_r($altaPropiedad);
//    echo $operacion . $provincia . $partido . $tipo . $direccion . $precio . $tamano . $descripcion . $usuario;

} else {
    echo 'no estas logueado';
}


