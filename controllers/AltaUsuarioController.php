
<?php

require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$nombre = $request->nombre;
$apellido = $request->apellido;
$usuario = $request->usuario;
$correo = $request->correo;
$c1 = md5($request->claveUno);
$c2 = md5($request->claveDos);

if($c1 != $c2){
    $obj = (object) array('estado' => 'error', 'descripcion' => 'Las contraseñas no son iguales');
    output($obj);
}

    $connect = new ConnectDB();
    $d = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $c1);

    if($d == 1){
        session_start();
        $_SESSION["usuario"] = $usuario;
        $obj = (object) array('estado' => 'OK', 'descripcion' => 'El usuario se cargo correctamente');
        output($obj);
    }
?>