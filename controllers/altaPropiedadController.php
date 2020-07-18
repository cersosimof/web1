
<?php
require_once("../models/ConnectDB.php");

if( (isset($_POST["operacion"])) && (isset($_POST["provincia"])) && (isset($_POST["partido"])) && (isset($_POST["tipo"])) && (isset($_POST["direccion"])) && (isset($_POST["precio"])) && (isset($_POST["tamano"])) && (isset($_POST["descripcion"])) && (isset($_POST["usuario"])) ){

    $operacion = $_POST["operacion"];
    $provincia = $_POST["provincia"];
    $partido = $_POST["partido"];
    $tipo = $_POST["tipo"];
    $direccion = $_POST["direccion"];
    $precio = $_POST["precio"];
    $tamano = $_POST["tamano"];
    $descripcion = $_POST["descripcion"];
    $usuario = $_POST["usuario"];

    echo $usuario;
}


//echo $operacion;
//$connect = new ConnectDB();
//$d = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave);


require_once("../views/altaPropiedad.php");
?>