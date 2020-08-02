<?php session_start();
    include("VariablesEntorno.php");
?>


<!doctype html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
</head>
<body>
<input type="hidden" value="<?php echo Constants::ENTORNO; ?>" id="idEntorno">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" style="padding: 0px 25px">
        <a class="navbar-brand" href="#">ALQUILERES</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION["usuario"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#!/altaPropiedad">Publicar!</a>
                    </li>
                <?php } ?>
            </ul>
            <span class="navbar-text" style="display: contents;">
                <?php
                if (isset($_SESSION["usuario"])) {
                    if (Constants::ENTORNO == "dev") {
                        echo "Bienvenido " . $_SESSION["usuario"] . "!" . "<a class=\"nav-link\" href=\"/web1/controllers/close_session.php\">Cerrar sesion</a>";
                    } else {
                        echo "Bienvenido " . $_SESSION["usuario"] . "!" . "<a class=\"nav-link\" href=\"../controllers/close_session.php\">Cerrar sesion</a>";
                    }
                } else {
                    if (Constants::ENTORNO == "dev") {
                        echo "" . "<a class=\"nav-link\" href=\"/web1/#!/login/0\">Iniciar sesion</a>";
                    } else {
                        echo "" . "<a class=\"nav-link\" href=\"#!/login/0\">Iniciar sesion</a>";
                    }
                };
                ?>
              </span>
        </div>
    </div>
</nav>
<!--CUERPO -->
<div>
    <div ng-view></div>
</div>
</body>
</html>


<script>

    var app = angular.module("app", ["ngRoute"]);

    /*
    * ENRUTADOR
    */

    app.config(function ($routeProvider) {
        $routeProvider
            .when("/", {
                templateUrl: "controllers/HomeController.php",
                controller: 'paginaPrincipalController'
            })
            .when("/login/:p1", {
                templateUrl: "views/LoginView.php",
                controller : "loginForm"
            })
            .when("/altaUsuario", {
                templateUrl: "views/AltaUsuarioVista.php",
                controller : "altaUsuario"
            })
            .when("/altaPropiedad", {
                templateUrl: "views/altaPropiedad.php",
                controller: 'formAltaPropiedad'
            })
            .when("/busqueda/:p1/:p2/:p3/:p4", {
                templateUrl: "views/BusquedaVista.php",
                controller: 'paginaMostrarResultados'
            })
            .when("/propiedad/:p1", {
                templateUrl: "views/vistaPropiedad.php",
                controller: 'vistaPropiedadController'
            })
            .when("/administrador/:v1/:v2", {
                templateUrl: "views/AdministradorVista.php",
                controller: 'administrador'
            })
    });

    // CONTROLADOR DE ENTORNO
    var entorno = angular.element(document.getElementById('idEntorno'))[0].value;
    if(entorno == "dev") {
        var miPath = "/web1/"
    } else {
        var miPath = "../"
    }

    // Controller del "/", carga las 4 propiedades mas recientes
    app.controller('paginaPrincipalController', function ($scope, $http) {
        $scope.path = miPath;
        $scope.cuatroPropiedades = []

        $http({
            method: 'POST',
            url: miPath + '/controllers/traerPropiedadesMasNuevas.php',
        }).then(function successCallback(response) {
            response.data.forEach((x)=> {
                $scope.cuatroPropiedades.push(x)
            })
        }, function errorCallback(response) {
            console.error(response)
        });
    })

    // CONTROLADOR DEL BUSCADOR
    app.controller('controladorBuscador', function ($scope, $http) {
        let operacion = 1;

        $scope.activarOperacion = function (op) {
            operacion = op;
            var botonVenta = angular.element(document.querySelector('#operacion_1'));
            var botonAlquiler = angular.element(document.querySelector('#operacion_2'));
            
            // Efecto fondo boton.
            botonVenta.removeClass('botonSeleccionado');
            botonAlquiler.removeClass('botonSeleccionado');
            if (operacion == 1) {
                botonVenta.addClass('botonSeleccionado');
            } else {
                botonAlquiler.addClass('botonSeleccionado');
            }
        }

        $scope.enviarBusqueda = function () {
            location.href = '#!/busqueda/' + operacion + '/' + $scope.provinciaABuscar + '/' + $scope.partidoABuscar + '/0';
        }
    })

    // CONTROLADOR PANTALLA INICIO DE SESION
    app.controller('loginForm', function ($scope, $http, $routeParams) {
        var param = $routeParams.p1;

        if(param == 0) {
            $scope.mensaje = "Bienvenido, ingrese los datos para ingresar, o registrese."
        } else {
            $scope.mensaje = "Para ingresar a este contenido debe estar logueado."
        }
        $scope.enviarDatosLogin = function () {
            $http({
                method: 'POST',
                url: miPath + 'controllers/LoginController.php',
                data: { usuario: $scope.usuarioLogin, clave: $scope.passLogin },
            }).then(function successCallback(response) {
                console.log(response.data)
                if (response.data === 0) {
                    alert("No se encontraron coincidencias en su busqueda.")
                } else if (response.data.idd == 123){
                    location.href = miPath + '#!/administrador/0/0';
                    location.reload()
                } else {
                    location.href = miPath;
                }
            }, function errorCallback(response) {
                console.error(response)
            });
        }
    })

    // CONTROLADOR PANTALLA ALTA USAURIO
    app.controller('altaUsuario', function ($scope, $http) {
        $scope.altaNuevoUsuario = function () {
            $http({
                method: 'POST',
                url: miPath + 'controllers/AltaUsuarioController.php',
                data: {
                    nombre: $scope.nombreNuevoUsuario,
                    apellido: $scope.apellidoNuevoUsuario,
                    usuario: $scope.usuarioNuevoUsuario,
                    correo: $scope.correoNuevoUsuario,
                    claveUno: $scope.clave1NuevoUsuario,
                    claveDos: $scope.clave2NuevoUsuario,
                },
            }).then(function successCallback(response) {
                if (response.data.estado == "OK") {
                    alert(response.data.descripcion)
                    location.href = miPath;
                } else {
                    alert(response.data.descripcion)
                }
            }, function errorCallback(response) {
                console.error(response)
            });
        }
    })

    // PAGINA CON TODOS LOS RESULTADOS DE BUSQUEDA
    app.controller('paginaMostrarResultados', function ($scope, $routeParams, $http) {
        $scope.a = $routeParams.p1;
        $scope.b = $routeParams.p3;
        $scope.propiedades = [];
        $scope.op = ($routeParams.p1 == 1) ? 'Venta' : 'Alquiler';
        $http({
            method: 'POST',
            url: miPath + '/controllers/BusquedaController.php',
            data: {
                pOperacion: $routeParams.p1,
                pProvincia: $routeParams.p2,
                pPartido: $routeParams.p3,
                pOrden: $routeParams.p4
            },
        }).then(function successCallback(response) {
            response.data.forEach((x) => {
                $scope.propiedades.push(x)
            })
            $scope.cantidadResultados = $scope.propiedades.length;
            $scope.path = miPath;
        }, function errorCallback(response) {
            console.error(response)
        });
    })


    // DIRECTIVA PARA SUBIDA DE IMAGENES
    app.directive("fileInput", function ($parse) {
        return {
            link: function ($scope, element, attrs) {
                element.on("change", function (event) {
                    var files = event.target.files;
                    $parse(attrs.fileInput).assign($scope, element[0].files);
                    $scope.$apply();
                });
            }
        }
    });

    // DETALLE DE UNA PROPIEDAD
    app.controller('vistaPropiedadController', function ($scope, $routeParams, $http) {

        $scope.listaMensajes = [];
        $scope.botonEnviarMensaje = "Enviar";


        $http({
            method: 'POST',
            url: miPath + '/controllers/traerUnaPropiedadController.php',
            data: {pPropiedad: $routeParams.p1},
        }).then(function successCallback(response) {
            $scope.datosPropiedad = response.data;
        }, function errorCallback(response) {
            console.error(response)
        });

        $http({
            method: 'POST',
            url: miPath + '/controllers/TraerMensajesPropiedadAJAX.php',
            data: {pPropiedad: $routeParams.p1},
        }).then(function successCallback(response) {
            response.data.forEach((x) => {
                $scope.listaMensajes.push(x)
            })

        }, function errorCallback(response) {
            console.error(response)
        });

        $scope.enviarComentario = function ($usuario) {
            if($scope.textoComentario != "") {
                $scope.botonEnviarMensaje = "Enviando...";
                $http({
                    method: 'POST',
                    url: miPath + 'controllers/CargarComentarioAJAX.php',
                    data: { propiedad: $routeParams.p1, usuario : $usuario, mensaje : $scope.textoComentario },
                }).then(function successCallback(response) {
                    $scope.listaMensajes.push({ id : $routeParams.p1, usuario : $usuario, mensaje : $scope.textoComentario, fecha : "Hace unos instantes..." })
                    $scope.textoComentario = "";
                    $scope.botonEnviarMensaje = "Enviar";
                }, function errorCallback(response) {
                    console.error(response)
                    $scope.botonEnviarMensaje = "Enviar";
                });
            } else {
                alert("Ingrese un texto a enviar")
            }

        }

        console.log($scope.listaMensajes)
    })

    // FORMULARIO DE ALTA DE PROPIEDAD
    app.controller('formAltaPropiedad', function ($scope, $http) {
        $scope.textoBoton = "Enviar"

        $scope.enviarInfoPropiedad = function () {
            $scope.textoBoton = "Enviando..."

            // VARIABLE ENVIO DE IMAGEN
            var form_data = new FormData();
            angular.forEach($scope.files, function (file) {
                form_data.append('file', file);
            });

            $http({
                method: 'POST',
                url: miPath + '/controllers/SubirImagenController.php',
                data: form_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            }).then(function successCallback(response) {
                //SI LA IMAGEN SE SUBE BIEN, SE RECIBE EL NOMBRE EN LA REPUESTA Y SE ENVIA EN EL OBJETO
                var propiedad =
                    {
                        operacion: $scope.operacionAlta,
                        provincia: $scope.provinciaAlta,
                        partido: $scope.partidoAlta,
                        tipo: $scope.tipoAlta,
                        direccion: $scope.direccionAlta,
                        precio: $scope.precioAlta,
                        tamano: $scope.tamanoAlta,
                        descripcion: $scope.descripcionAlta,
                        foto: response.data
                    }

                $http({
                    method: 'POST',
                    url: miPath + '/controllers/ProcesarAltaPropiedadController.php',
                    data: propiedad,
                }).then(function successCallback(response) {
                    if (response.data.id != 0) {
                        alert(response.data.descripcion)
                    }
                    $scope.textoBoton = "Enviar"
                }, function errorCallback(response) {
                    console.error(response)
                    $scope.textoBoton = "Enviar"
                });
            }, function errorCallback(response) {
                console.error(response)
                $scope.textoBoton = "Enviar"
            });
        }
    })

    // ADMINISTRADOR
    app.controller('administrador', function ($scope, $http, $routeParams) {

        let producto = $routeParams.v1;
        let id = $routeParams.v2;

        $scope.productoVisible = $routeParams.v1;
        $scope.idVisible = $routeParams.v2;

        // Usuario Modificacion
        $scope.nombreUpdate = ''
        $scope.apellidoUpdate = ''
        $scope.usuarioUpdate = ''
        $scope.correoUpdate = ''
        $scope.claveUpdate = ''

        // Modificador de Estado Usuario
        $scope.change = function (x, y) {
            if(y == "nombreUpdate"){
                $scope.nombreUpdate = x;
            } else if (y == "apellidoUpdate") {
                $scope.apellidoUpdate = x;
            } else if (y == "usuarioUpdate") {
                $scope.usuarioUpdate = x;
            } else if (y == "correoUpdate") {
                $scope.correoUpdate = x;
            } else if (y == "claveUpdate") {
                $scope.claveUpdate = x;
            } else {
                console.error("Error")
           }
        }

        // Propiedad Modificacion
        $scope.operacionUpdate = ''
        $scope.provinciaUpdate = ''
        $scope.partidoUpdate = ''
        $scope.tipoUpdate = ''
        $scope.direccionUpdate = ''
        $scope.precioUpdate = ''
        $scope.tamanoUpdate = ''
        $scope.descripcionUpdate = ''
        $scope.fotoUpdate = ''

        // Modificador de Estado Usuario
        $scope.change = function (x, y) {
            if(y == "operacionUpdate"){
                $scope.operacionUpdate = x;
            } else if (y == "provinciaUpdate") {
                $scope.provinciaUpdate = x;
            } else if (y == "partidoUpdate") {
                $scope.partidoUpdate = x;
            } else if (y == "tipoUpdate") {
                $scope.tipoUpdate = x;
            } else if (y == "direccionUpdate") {
                $scope.direccionUpdate = x;
            } else if (y == "precioUpdate") {
                $scope.precioUpdate = x;
            } else if (y == "tamanoUpdate") {
                $scope.tamanoUpdate = x;
            } else if (y == "descripcionUpdate") {
                $scope.descripcionUpdate = x;
            } else if (y == "fotoUpdate") {
                $scope.fotoUpdate = x;
            } else {
                console.error("Error")
            }
        }

        // SI ES 1 MODIFICA PROPIEDADES
        if($routeParams.v1 == 1){
            $http({
                method: 'POST',
                url: miPath + 'controllers/Administrador.php',
                data: {
                    productoP : producto,
                    idP : id
                },
            }).then(function successCallback(response) {

                $scope.id = response.data.id
                $scope.operacion = response.data.id_operacion
                $scope.provincia = response.data.id_provincia
                $scope.partido = response.data.id_partido
                $scope.tipoUpdate = response.data.tipo
                $scope.direccionUpdate = response.data.direccion
                $scope.precioUpdate = response.data.precio
                $scope.tamanoUpdate = response.data.m2
                $scope.descripcionUpdate = response.data.descripcion
                $scope.fotoUpdate = response.data.imagen
                $scope.fotoUpdateParaMostrar = response.data.imagen

                // OPERACIONES
                $scope.myoptions = [
                    {value: 1, label: 'Venta'},
                    {value: 2, label: 'Alquiler'}
                ];
                $scope.operacionUpdate = $scope.myoptions[$scope.operacion-1];

                // PROVINCIA
                $scope.arrayProvincias = [
                    {value: 1, label: 'Buenos Aires'},

                ];
                $scope.provinciaUpdate = $scope.arrayProvincias[$scope.provincia-1];

                // PARTIDO
                $scope.arrayPartido = [
                    { value: 0, label : 'Todos' },
                    { value: 1 , label : 'Adolfo Alsina' },
                    { value: 2 , label : 'Adolfo Gonzales Chaves' },
                    { value: 3 , label : 'Alberti' },
                    { value: 4 , label : 'Almirante Brown' },
                    { value: 5 , label : 'Arrecifes' },
                    { value: 6 , label : 'Avellaneda' },
                    { value: 7 , label : 'Ayacucho' },
                    { value: 8 , label : 'Azul' },
                    { value: 9 , label : 'Bahía Blanca' },
                    { value: 10 , label : 'Balcarce' },
                    { value: 11 , label : 'Baradero' },
                    { value: 12 , label : 'Benito Juárez' },
                    { value: 13 , label : 'Berazategui' },
                    { value: 14 , label : 'Berisso' },
                    { value: 15 , label : 'Bolívar' },
                    { value: 16 , label : 'Bragado' },
                    { value: 17 , label : 'Brandsen' },
                    { value: 18 , label : 'Campana' },
                    { value: 19 , label : 'Cañuelas' },
                    { value: 20 , label : 'Capitán Sarmiento' },
                    { value: 21 , label : 'Carlos Casares' },
                    { value: 22 , label : 'Carlos Tejedor' },
                    { value: 23 , label : 'Carmen de Areco' },
                    { value: 24 , label : 'Castelli' },
                    { value: 25 , label : 'Chacabuco' },
                    { value: 26 , label : 'Chascomús' },
                    { value: 27 , label : 'Chivilcoy' },
                    { value: 28 , label : 'Colón' },
                    { value: 29 , label : 'Coronel Dorrego' },
                    { value: 30 , label : 'Coronel Pringles' },
                    { value: 31 , label : 'Coronel Rosales' },
                    { value: 32 , label : 'Coronel Suárez' },
                    { value: 33 , label : 'Daireaux' },
                    { value: 34 , label : 'Dolores' },
                    { value: 35 , label : 'Ensenada' },
                    { value: 36 , label : 'Escobar' },
                    { value: 37 , label : 'Esteban Echeverría' },
                    { value: 38 , label : 'Exaltación de la Cruz' },
                    { value: 39 , label : 'Ezeiza' },
                    { value: 40 , label : 'Florencio Varela' },
                    { value: 41 , label : 'Florentino Ameghino' },
                    { value: 42 , label : 'General Alvarado' },
                    { value: 43 , label : 'General Alvear' },
                    { value: 44 , label : 'General Arenales' },
                    { value: 45 , label : 'General Belgrano' },
                    { value: 46 , label : 'General Guido' },
                    { value: 47 , label : 'General Juan Madariaga' },
                    { value: 48 , label : 'General La Madrid' },
                    { value: 49 , label : 'General Las Heras' },
                    { value: 50 , label : 'General Lavalle' },
                    { value: 51 , label : 'General Paz' },
                    { value: 52 , label : 'General Pinto' },
                    { value: 53 , label : 'General Pueyrredón' },
                    { value: 54 , label : 'General Rodríguez' },
                    { value: 55 , label : 'General San Martín' },
                    { value: 56 , label : 'General Viamonte' },
                    { value: 57 , label : 'General Villegas' },
                    { value: 58 , label : 'Guaminí' },
                    { value: 59 , label : 'Hipólito Yrigoyen' },
                    { value: 60 , label : 'Hurlingham' },
                    { value: 61 , label : 'Ituzaingó' },
                    { value: 62 , label : 'José C. Paz' },
                    { value: 63 , label : 'Junín' },
                    { value: 64 , label : 'La Costa' },
                    { value: 65 , label : 'La Matanza' },
                    { value: 66 , label : 'La Plata' },
                    { value: 67 , label : 'Lanús' },
                    { value: 68 , label : 'Laprida' },
                    { value: 69 , label : 'Las Flores' },
                    { value: 70 , label : 'Leandro N. Alem' },
                    { value: 71 , label : 'Lezama' },
                    { value: 72 , label : 'Lincoln' },
                    { value: 73 , label : 'Lobería' },
                    { value: 74 , label : 'Lobos' },
                    { value: 75 , label : 'Lomas de Zamora' },
                    { value: 76 , label : 'Luján' },
                    { value: 77 , label : 'Magdalena' },
                    { value: 78 , label : 'Maipú' },
                    { value: 79 , label : 'Malvinas Argentinas' },
                    { value: 80 , label : 'Mar Chiquita' },
                    { value: 81 , label : 'Marcos Paz' },
                    { value: 82 , label : 'Mercedes' },
                    { value: 83 , label : 'Merlo' },
                    { value: 84 , label : 'Monte' },
                    { value: 85 , label : 'Monte Hermoso' },
                    { value: 86 , label : 'Moreno' },
                    { value: 87 , label : 'Morón' },
                    { value: 88 , label : 'Navarro' },
                    { value: 89 , label : 'Necochea' },
                    { value: 90 , label : 'Nueve de Julio' },
                    { value: 91 , label : 'Olavarría' },
                    { value: 92 , label : 'Patagones' },
                    { value: 93 , label : 'Pehuajó' },
                    { value: 94 , label : 'Pellegrini' },
                    { value: 95 , label : 'Pergamino' },
                    { value: 96 , label : 'Pila' },
                    { value: 97 , label : 'Pilar' },
                    { value: 98 , label : 'Pinamar' },
                    { value: 99 , label : 'Presidente Perón' },
                    { value: 100 , label : 'Puan' },
                    { value: 101 , label : 'Punta Indio' },
                    { value: 102 , label : 'Quilmes' },
                    { value: 103 , label : 'Ramallo' },
                    { value: 104 , label : 'Rauch' },
                    { value: 105 , label : 'Rivadavia' },
                    { value: 106 , label : 'Rojas' },
                    { value: 107 , label : 'Roque Pérez' },
                    { value: 108 , label : 'Saavedra' },
                    { value: 109 , label : 'Saladillo' },
                    { value: 110 , label : 'Salliqueló' },
                    { value: 111 , label : 'Salto' },
                    { value: 112 , label : 'San Andrés de Giles' },
                    { value: 113 , label : 'San Antonio de Areco' },
                    { value: 114 , label : 'San Cayetano' },
                    { value: 115 , label : 'San Fernando' },
                    { value: 116 , label : 'San Isidro' },
                    { value: 117 , label : 'San Miguel' },
                    { value: 118 , label : 'San Nicolás' },
                    { value: 119 , label : 'San Pedro' },
                    { value: 120 , label : 'San Vicente' },
                    { value: 121 , label : 'Suipacha' },
                    { value: 122 , label : 'Tandil' },
                    { value: 123 , label : 'Tapalqué' },
                    { value: 124 , label : 'Tigre' },
                    { value: 125 , label : 'Tordillo' },
                    { value: 126 , label : 'Tornquist' },
                    { value: 127 , label : 'Trenque Lauquen' },
                    { value: 128 , label : 'Tres Arroyos' },
                    { value: 129 , label : 'Tres de Febrero' },
                    { value: 130 , label : 'Tres Lomas' },
                    { value: 131 , label : 'Veinticinco de Mayo' },
                    { value: 132 , label : 'Vicente López' },
                    { value: 133 , label : 'Villa Gesell' },
                    { value: 134 , label : 'Villarino' },
                    { value: 135 , label : 'Zárate' }
                ];
                $scope.partidoUpdate = $scope.arrayPartido[$scope.partido];

                // TIPO
                if($scope.tipoUpdate == "Casa") {
                    var number = 0;
                } else if ($scope.tipoUpdate == "Departamento") {
                    var number = 1;
                } else {
                    var number = 2;
                }
                $scope.arrayTipo = [
                    {value: "Casa", label: 'Casa'},
                    {value: "Departamento", label: 'Departamento'},
                    {value: "PH", label: 'PH'}
                ];
                $scope.tipoUpdate = $scope.arrayTipo[number];

            }, function errorCallback(response) {
                console.error(response)
            });
        } else {
            $http({
                method: 'POST',
                url: miPath + 'controllers/Administrador.php',
                data: {
                    productoP : producto,
                    idP : id
                },
            }).then(function successCallback(response) {
                $scope.id = response.data.id
                $scope.nombreUpdate = response.data.nombre
                $scope.apellidoUpdate = response.data.apellido
                $scope.usuarioUpdate = response.data.usuario
                $scope.correoUpdate = response.data.correo
                $scope.claveUpdate = response.data.clave
            }, function errorCallback(response) {
                console.error(response)
            });
        }


        $scope.interactuar = function (operacionN, idN) {
            $scope.productoVisible = 15;
            location.href = miPath = '#!/administrador/'+operacionN+'/'+idN;
            location.reload()
        }

        $scope.eliminarPropiedad = function () {

            if(confirm("¿Desea eliminar la propiedad " + $routeParams.v2 + "?")) {
                $http({
                    method: 'POST',
                    url: miPath + 'controllers/eliminarPropiedad.php',
                    data: {
                        id : $routeParams.v2
                    },
                }).then(function successCallback(response) {
                   alert(response.data)
                    location.reload()
                }, function errorCallback(response) {
                    console.error(response)
                });
            } else {
                alert("La propiedad no se elimino.")
            }
        }

        $scope.eliminarUsuario = function () {

            if(confirm("¿Desea eliminar el usuario " + $routeParams.v2 + "?")) {
                $http({
                    method: 'POST',
                    url: miPath + 'controllers/eliminarUsuario.php',
                    data: {
                        id : $routeParams.v2
                    },
                }).then(function successCallback(response) {
                    alert(response.data)
                    location.reload()
                }, function errorCallback(response) {
                    console.error(response)
                });
            } else {
                alert("El usaurio no se elimino.")
            }
        }

        $scope.modificarUsuario = function () {

            if(confirm("¿Desea modificar el usuario " + $routeParams.v2 + "?")) {
                $http({
                    method: 'POST',
                    url: miPath + 'controllers/modificarUsuario.php',
                    data: {
                        id : $routeParams.v2,
                        nombre : $scope.nombreUpdate,
                        apellido : $scope.apellidoUpdate,
                        usuario : $scope.usuarioUpdate,
                        correo : $scope.correoUpdate,
                        claveUno : $scope.claveUpdate
                    },
                }).then(function successCallback(response) {
                    alert(response.data)
                    location.reload()
                }, function errorCallback(response) {
                    console.error(response)
                });
            } else {
                alert("El usaurio no se elimino.")
            }
        }

        $scope.modificarPropiedad = function () {

            if(confirm("¿Desea modificar la propiedad " + $routeParams.v2 + "?")) {
                $http({
                    method: 'POST',
                    url: miPath + 'controllers/modificarPropiedad.php',
                    data: {
                        id : $routeParams.v2,
                        operacion : $scope.operacionUpdate.value,
                        provincia : $scope.provinciaUpdate.value,
                        partido : $scope.partidoUpdate.value,
                        tipo : $scope.tipoUpdate.value,
                        direccion : $scope.direccionUpdate,
                        precio : $scope.precioUpdate,
                        tamano : $scope.tamanoUpdate,
                        descripcion : $scope.descripcionUpdate,
                        foto : ($scope.fotoUpdate == 1) ? 'default.jpg' : 0
                    },
                }).then(function successCallback(response) {
                    alert(response.data)
                    location.reload()
                }, function errorCallback(response) {
                    console.error(response)
                });
            } else {
                alert("la propiedad no se modifocp.")
            }
        }
    })


</script>
