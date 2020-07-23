<?php
session_start();
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$connect = new ConnectDB();

if(isset($_SESSION["usuario"])){

//    if(!empty($_FILES))
//    {
//        //Linea que le dice a donde subirla.
//        $path = '../imagenesPropiedades/' . $_FILES['file']['name'];
//        //Linea que sube la imagen a mi carpeta.
//        move_uploaded_file($_FILES['file']['tmp_name'], $path);
//    }
//    else
//    {
//        echo 'Some Error';
//    }
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
    $foto = $request->foto;



$altaPropiedad = $connect->insertarNuevaPropiedad($operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $usuario, $foto);

if($altaPropiedad != 0) {
    $obj = (object) array('estado' => 'OK', 'descripcion' => 'El registro se cargo correctamente.', 'id' => $altaPropiedad);
    output($obj);
} else {
    $obj = (object) array('estado' => 'Error', 'descripcion' => 'Problema al cargar el registro.', 'id' => $altaPropiedad);
    output($obj);
}

} else {
    echo 'no estas logueado';
}


