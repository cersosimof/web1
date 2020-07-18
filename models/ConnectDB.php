<?php

class ConnectDB {
    private $user;
    private $pass;
    private $host;
    private $db;

    function __construct()
    {
        $this->user = 'root';
        $this->pass = '';
        $this->host = 'localhost';
        $this->db = 'web1';
    }

    private function abrirConexion()
    {
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if ($link === false) {
            print "Falló la conexión: " . mysqli_connect_error();
            die;
        }
        return $link;
    }

    public function ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave) {
        $link = $this->abrirConexion();
        $queryInsercion = mysqli_query($link, "INSERT INTO usuarios (nombre, apellido, usuario, correo, clave) VALUES ('$nombre', '$apellido', '$usuario', '$correo', '$clave')");
        return $queryInsercion;
        mysqli_close($link);
    }

    public function insertQuery() {
        $link = $this->abrirConexion();

        if ($resultado = mysqli_query($link, "INSERT INTO usuarios (nombre) VALUES ('papapa')"))
        {
            print htmlentities("La selección devolvió ". mysqli_num_rows($resultado)." fila(s)").".<br>";
            mysqli_free_result($resultado);
        } else {
            print "Fallo la consulta: ". mysqli_error($link);
            die;
        }
        mysqli_close($link);
    }

    public function loguearUsuario($nombre, $clave) {
        $link = $this->abrirConexion();
        $queryBuscarUsuario = mysqli_query($link, "select id, nombre, apellido, usuario, correo from usuarios where usuario = '$nombre' AND clave = '$clave'");

        //No se encontraron resultados
        if($queryBuscarUsuario===false){
            return 0;
        }

        $persona = mysqli_fetch_assoc($queryBuscarUsuario);

//        if(!$queryBuscarUsuario) {
//            die ('No se pudo conectar' . mysqli_error());
//        }

        return $persona;

        mysqli_close($link);
    }

public function traerPartidos(){
    $buenosAires = [];
    $link = $this->abrirConexion();
    $queryBuscarPartidos = mysqli_query($link, "SELECT * FROM partidos_bsas");

    while($fila = mysqli_fetch_assoc($queryBuscarPartidos)) {
        $buenosAires[] = $fila;
    }

    return $buenosAires;
}



}


