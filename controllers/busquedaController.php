
<?php
$op = $_POST["operacion"];
$provincia = $_POST["provincia"];
$partido = $_POST["partido"];


require_once("../models/ConnectDB.php");

$connect = new ConnectDB();
$d = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave);


require_once("../views/AltaUsuarioVista.php");
?>