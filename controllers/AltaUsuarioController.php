
<?php

require_once("../models/ConnectDB.php");

if( (isset($_POST["nombre"])) && (isset($_POST["apellido"])) && (isset($_POST["usuario"])) && (isset($_POST["correo"])) && (isset($_POST["clave"])) ) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];


    $connect = new ConnectDB();
    $d = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave);
}

require_once("../views/AltaUsuarioVista.php");
?>