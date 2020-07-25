<?php

class ConnectDB {
    private $user;
    private $pass;
    private $host;
    private $db;

    function __construct()
    {
        $this->user = 'id14462825_cersosimof';
        $this->pass = 's2]sF7aOQwg^J!M@';
        $this->host = 'localhost';
        $this->db = 'id14462825_web1';
    }

//    function __construct()
//    {
//        $this->user = 'root';
//        $this->pass = '';
//        $this->host = 'localhost';
//        $this->db = 'web1';
//    }

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
    // INSERTAR NUEVA PROPIEDAD
    public function insertarNuevaPropiedad($operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $usuario, $foto) {
        $link = $this->abrirConexion();

        $sqlBuscarUsuario = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlBuscarUsuario);
        $idUsuario = mysqli_fetch_assoc($ejecutarBusquedaUsuario);
        $usuario =  $idUsuario["id"];

        $sql = "INSERT INTO departamentos (id, id_operacion, id_provincia, id_partido, direccion, descripcion, id_usuario, precio, m2, tipo, imagen) VALUES (NULL, '$operacion', '$provincia', '$partido', '$direccion', '$descripcion', '$usuario', '$precio', '$tamano', '$tipo', '$foto');";
        if (mysqli_query($link, $sql)) {
            return mysqli_insert_id($link);
        } else {
            return 0;
        }
    }

    public function traerTodasLasPropiedades($operacion, $partido, $orden) {
        $listaPropiedadesCompleto = [];
        $link = $this->abrirConexion();

        //Veridicador de partido
        if($partido == 0) {
            $partidoABuscar = " 1 = 1";
        } else {
            $partidoABuscar = "D.id_partido = '$partido'";
        }

        if($orden==0) {
            $ordenABuscar = '';
        } else if($orden==1){
            $ordenABuscar = ' ORDER BY D.precio ASC';
        } else if($orden==2){
            $ordenABuscar = ' ORDER BY D.precio DESC';
        } else if($orden==3){
            $ordenABuscar = ' ORDER BY D.m2 ASC';
        } else if($orden==4){
            $ordenABuscar = ' ORDER BY D.m2 DESC';
        }

        $sqlTraerTodasLasPropiedades = "SELECT D.id, Pr.nombre AS provincia, P.partido, O.operacion, D.precio, D.m2, U.usuario, D.tipo, D.descripcion, D.direccion, D.imagen
                                        FROM departamentos D
                                        left join partidos_bsas P
                                        on D.id_partido = P.id
                                        LEFT JOIN operaciones O
                                        on D.id_operacion = O.id
                                        LEFT JOIN provincias Pr
                                        ON D.id_provincia = Pr.id
                                        LEFT JOIN usuarios U
                                        ON D.id_usuario = U.id
                                        WHERE D.id_operacion = $operacion AND
                                        $partidoABuscar
                                        $ordenABuscar
                                        ";
        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlTraerTodasLasPropiedades);
        while($propiedad = mysqli_fetch_assoc($ejecutarBusquedaUsuario)) {
            $listaPropiedadesCompleto[] = $propiedad;
        }
        return $listaPropiedadesCompleto;

    }

    public function traerUnaPropiedad($propiedad) {
        $link = $this->abrirConexion();

        $sqlTraerUnaPropiedad = "SELECT D.id, Pr.nombre AS provincia, P.partido, O.operacion, D.precio, D.m2, U.usuario, D.tipo, D.descripcion, D.direccion, D.imagen
                                        FROM departamentos D
                                        left join partidos_bsas P
                                        on D.id_partido = P.id
                                        LEFT JOIN operaciones O
                                        on D.id_operacion = O.id
                                        LEFT JOIN provincias Pr
                                        ON D.id_provincia = Pr.id
                                        LEFT JOIN usuarios U
                                        ON D.id_usuario = U.id
                                        WHERE D.id = $propiedad";

        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlTraerUnaPropiedad);
        $propiedad = mysqli_fetch_assoc($ejecutarBusquedaUsuario);

        return $propiedad;

    }

}


