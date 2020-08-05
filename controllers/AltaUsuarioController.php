
<?php

require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$connect = new ConnectDB();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$nombre = $request->nombre;
$apellido = $request->apellido;
$usuario = $request->usuario;
$correo = $request->correo;
$c1 = md5($request->claveUno);
$c2 = md5($request->claveDos);

$d = $connect->buscarUsuario($usuario);

if($d == 1) {
    $obj = (object) array('estado' => 'error', 'descripcion' => 'El usuario ya existe');
    output($obj);
}

if($c1 != $c2){
    $obj = (object) array('estado' => 'error', 'descripcion' => 'Las contraseñas no son iguales');
    output($obj);
}

if($d == 0) {
    $r = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $c1);

    if($r == 1){
        session_start();
        $_SESSION["usuario"] = $usuario;
        $obj = (object) array('estado' => 'OK', 'descripcion' => 'El usuario se cargo correctamente');
        output($obj);
    }
}

?>