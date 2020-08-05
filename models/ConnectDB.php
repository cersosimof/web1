<?php

require_once("../VariablesEntorno.php");


class ConnectDB
{
    private $user;
    private $pass;
    private $host;
    private $db;

    function __construct()
    {

        if (Constants::ENTORNO == "dev") {
            $this->user = 'root';
            $this->pass = '';
            $this->host = 'localhost';
            $this->db = 'web1';
        } else {
            $this->user = 'id14462825_cersosimof';
            $this->pass = 'RSJ6s>oyAG1wroH!';
            $this->host = 'localhost';
            $this->db = 'id14462825_web1';
        }

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

    public function ingresarNuevoUsuario($nombre, $apellido, $usuario, $correo, $clave)
    {
        $link = $this->abrirConexion();
        $queryInsercion = mysqli_query($link, "INSERT INTO usuarios (nombre, apellido, usuario, correo, clave) VALUES ('$nombre', '$apellido', '$usuario', '$correo', '$clave')");
        return $queryInsercion;
        mysqli_close($link);
    }

    public function insertQuery()
    {
        $link = $this->abrirConexion();

        if ($resultado = mysqli_query($link, "INSERT INTO usuarios (nombre) VALUES ('papapa')")) {
            print htmlentities("La selección devolvió " . mysqli_num_rows($resultado) . " fila(s)") . ".<br>";
            mysqli_free_result($resultado);
        } else {
            print "Fallo la consulta: " . mysqli_error($link);
            die;
        }
        mysqli_close($link);
    }

    public function loguearUsuario($nombre, $clave)
    {
        $link = $this->abrirConexion();
        $queryBuscarUsuario = mysqli_query($link, "select id, nombre, apellido, usuario, correo from usuarios where usuario = '$nombre' AND clave = '$clave'");

        //No se encontraron resultados
        if ($queryBuscarUsuario === false) {
            return 0;
        }

        $persona = mysqli_fetch_assoc($queryBuscarUsuario);

//        if(!$queryBuscarUsuario) {
//            die ('No se pudo conectar' . mysqli_error());
//        }

        return $persona;

        mysqli_close($link);
    }

    public function traerPartidos()
    {
        $buenosAires = [];
        $link = $this->abrirConexion();
        $queryBuscarPartidos = mysqli_query($link, "SELECT * FROM partidos_bsas");

        while ($fila = mysqli_fetch_assoc($queryBuscarPartidos)) {
            $buenosAires[] = $fila;
        }

        return $buenosAires;
    }

    // INSERTAR NUEVA PROPIEDAD
    public function insertarNuevaPropiedad($operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $usuario, $foto)
    {
        $link = $this->abrirConexion();

        $sqlBuscarUsuario = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlBuscarUsuario);
        $idUsuario = mysqli_fetch_assoc($ejecutarBusquedaUsuario);
        $usuario = $idUsuario["id"];

        $sql = "INSERT INTO departamentos (id, id_operacion, id_provincia, id_partido, direccion, descripcion, id_usuario, precio, m2, tipo, imagen) VALUES (NULL, '$operacion', '$provincia', '$partido', '$direccion', '$descripcion', '$usuario', '$precio', '$tamano', '$tipo', '$foto');";

        if (mysqli_query($link, $sql)) {
            return mysqli_insert_id($link);
        } else {
            return 0;
        }
    }

    public function traerTodasLasPropiedades($operacion, $partido, $orden)
    {
        $listaPropiedadesCompleto = [];
        $link = $this->abrirConexion();

        //Veridicador de partido
        if ($partido == 0) {
            $partidoABuscar = " 1 = 1";
        } else {
            $partidoABuscar = "D.id_partido = '$partido'";
        }

        if ($orden == 0) {
            $ordenABuscar = '';
        } else if ($orden == 1) {
            $ordenABuscar = ' ORDER BY D.precio ASC';
        } else if ($orden == 2) {
            $ordenABuscar = ' ORDER BY D.precio DESC';
        } else if ($orden == 3) {
            $ordenABuscar = ' ORDER BY D.m2 ASC';
        } else if ($orden == 4) {
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
        while ($propiedad = mysqli_fetch_assoc($ejecutarBusquedaUsuario)) {
            $listaPropiedadesCompleto[] = $propiedad;
        }
        return $listaPropiedadesCompleto;

    }

    public function traerUnaPropiedad($propiedad)
    {
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

    public function traerUnaPropiedadADM($propiedad)
    {
        $link = $this->abrirConexion();

        $sqlTraerUnaPropiedad = "SELECT D.id, D.id_provincia, D.id_partido, D.id_operacion, D.precio, D.m2, U.usuario, D.tipo, D.descripcion, D.direccion, D.imagen
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

    public function traerTodosLosUsuariosADM()
    {
        $link = $this->abrirConexion();
        $listaUsuarios = [];

        $sqlTraerUsuarios = "SELECT * FROM usuarios";

        $traerUsuarios = mysqli_query($link, $sqlTraerUsuarios);
        while ($usuario = mysqli_fetch_assoc($traerUsuarios)) {
            $listaUsuarios[] = $usuario;
        }
        return $listaUsuarios;
    }

    public function traerUnUsuarioADM($id)
    {
        $link = $this->abrirConexion();

        $traerUnUsuario = "SELECT * FROM usuarios WHERE id = '$id'";

        $traerUsuario = mysqli_query($link, $traerUnUsuario);
        $usuario = mysqli_fetch_assoc($traerUsuario);

        return $usuario;
    }


    public function traerCuatroPropiedades()
    {
        $link = $this->abrirConexion();
        $listaPropiedadesCompleto = [];
        $traer4Propiedades = "SELECT D.id, Pr.nombre AS provincia, P.partido, O.operacion, D.precio, D.m2, U.usuario, D.tipo, D.descripcion, D.direccion, D.imagen
                                        FROM departamentos D
                                        left join partidos_bsas P
                                        on D.id_partido = P.id
                                        LEFT JOIN operaciones O
                                        on D.id_operacion = O.id
                                        LEFT JOIN provincias Pr
                                        ON D.id_provincia = Pr.id
                                        LEFT JOIN usuarios U
                                        ON D.id_usuario = U.id
                                        ORDER BY D.id DESC
                                        LIMIT 4";

        $ejecutarBusquedaUsuario = mysqli_query($link, $traer4Propiedades);
        while ($propiedad = mysqli_fetch_assoc($ejecutarBusquedaUsuario)) {
            $listaPropiedadesCompleto[] = $propiedad;
        }
        return $listaPropiedadesCompleto;

    }

    // Insertar nuevo comentario
    public function insertarComentario($nombreUsuario, $idPropiedad, $mensaje)
    {
        $link = $this->abrirConexion();

        $sqlBuscarUsuario = "SELECT id FROM usuarios WHERE usuario = '$nombreUsuario'";
        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlBuscarUsuario);
        $us = mysqli_fetch_assoc($ejecutarBusquedaUsuario);
        $idUsuario = $us["id"];
        date_default_timezone_set('UTC');
        $fecha_actual = new DateTime();
        $fecha_actual = new DateTime("America/Argentina/Buenos_Aires");
        $cadena_fecha_actual = $fecha_actual->format("d/m/Y, g:i a");

        $sqlInsertarMensaje = "INSERT INTO mensajes_propiedades  VALUES (null, '$idUsuario', '$idPropiedad', '$mensaje', '$cadena_fecha_actual')";

        if (mysqli_query($link, $sqlInsertarMensaje)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function traerMensajes($idPropiedad)
    {
        $listaMensajes = [];
        $link = $this->abrirConexion();
        $queryBuscarMensajes = mysqli_query($link, "SELECT M.id, U.usuario, M.mensaje, M.fecha
                                                            FROM mensajes_propiedades M
                                                            LEFT JOIN usuarios U
                                                            ON M.id_usuario = U.id
                                                            WHERE M.id_propiedad = '$idPropiedad'");

        while ($fila = mysqli_fetch_assoc($queryBuscarMensajes)) {
            $listaMensajes[] = $fila;
        }

        return $listaMensajes;
    }


    public function traerTodasLasPropiedadesADM()
    {
        $listaPropiedadesCompleto = [];
        $link = $this->abrirConexion();

        $sqlTraerTodasLasPropiedades = "SELECT D.id, Pr.nombre AS provincia, P.partido, O.operacion, D.precio, D.m2, U.usuario, D.tipo, D.descripcion, D.direccion, D.imagen
                                        FROM departamentos D
                                        left join partidos_bsas P
                                        on D.id_partido = P.id
                                        LEFT JOIN operaciones O
                                        on D.id_operacion = O.id
                                        LEFT JOIN provincias Pr
                                        ON D.id_provincia = Pr.id
                                        LEFT JOIN usuarios U
                                        ON D.id_usuario = U.id";

        $ejecutarBusquedaUsuario = mysqli_query($link, $sqlTraerTodasLasPropiedades);
        while ($propiedad = mysqli_fetch_assoc($ejecutarBusquedaUsuario)) {
            $listaPropiedadesCompleto[] = $propiedad;
        }
        return $listaPropiedadesCompleto;

    }

    public function eliminarPropiedadADM($id)
    {
        $link = $this->abrirConexion();

        $eliminarPropiedad = "DELETE FROM departamentos WHERE id = '$id'";

        if (mysqli_query($link, $eliminarPropiedad)) {
            echo "La propiedad fue eliminada";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }

    public function eliminarUsuarioADM($id)
    {
        $link = $this->abrirConexion();

        $eliminarUsuario = "DELETE FROM usuarios WHERE id = '$id'";

        if (mysqli_query($link, $eliminarUsuario)) {
            echo "El usuario fue eliminado";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }

    public function modificarUsuarioADM($id, $nombre, $apellido, $usuario, $correo, $c1)
    {
        $link = $this->abrirConexion();

        $modificarUsuario = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario', correo = '$correo', clave = '$c1' WHERE id = '$id' ";

        if (mysqli_query($link, $modificarUsuario)) {
            echo "El usuario fue modificado";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }

    public function modificarPropiedadADM($id, $operacion, $provincia, $partido, $tipo, $direccion, $precio, $tamano, $descripcion, $foto)
    {
        $link = $this->abrirConexion();

        if ($foto == "0") {
            $modificarUsuario = "UPDATE departamentos SET id_operacion=$operacion,id_provincia=$provincia,id_partido=$partido,direccion='$direccion',descripcion='$descripcion',precio=$precio, m2=$tamano ,tipo='$tipo' WHERE id = $id";
        } else {
            $modificarUsuario = "UPDATE departamentos SET id_operacion=$operacion,id_provincia=$provincia,id_partido=$partido,direccion='$direccion',descripcion='$descripcion',precio=$precio, m2=$tamano ,tipo='$tipo', imagen='$foto' WHERE id = $id";
        }

        if (mysqli_query($link, $modificarUsuario)) {
            echo "La propiedad fue modificada";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }

    public function buscarUsuario($usuario)
    {
        $link = $this->abrirConexion();
        $queryBuscarMensajes = mysqli_query($link, "SELECT * FROM usuarios WHERE usuario = '$usuario' ");
        $resultados = mysqli_affected_rows($link);

        return $resultados;
    }

}

