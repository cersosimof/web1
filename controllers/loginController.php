<?php


require_once("../models/ConnectDB.php");
    $connect = new ConnectDB();
    $d = $connect->ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave);
}

require_once("../views/loginView.php");
