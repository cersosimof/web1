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
                        echo "" . "<a class=\"nav-link\" href=\"/web1/#!/login\">Iniciar sesion</a>";
                    } else {
                        echo "" . "<a class=\"nav-link\" href=\"#!/login\">Iniciar sesion</a>";
                    }
                };
                ?>
              </span>
        </div>
    </div>
</nav>
<!--CUERPO -->
<div class="container">
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
                templateUrl: "controllers/homeController.php",
                controller: 'paginaPrincipalController'
            })
            .when("/altaUsuario", {
                templateUrl: "views/AltaUsuarioVista.php",
                controller : "altaUsuario"
            })
            .when("/login", {
                templateUrl: "views/login.php"
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
    });

    // CONTROLADOR DE ENTORNO
    var entorno = angular.element(document.getElementById('idEntorno'))[0].value;
    if(entorno == "dev") {
        var miPath = "/web1/"
    } else {
        var miPath = "../"
    }

    app.controller('paginaPrincipalController', function ($scope, $http) {
        $scope.path = miPath;
    })


    /*
    *
    */

    app.controller('mostrar4Propiedades', function ($scope, $http) {
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


    /*
    *
    */

    app.controller('loginForm', function ($scope, $http) {
        $scope.titulo = "Bienvenido, ingrese los datos para ingresar, o registrese."
        $scope.enviarDatosLogin = function () {
            $http({
                method: 'POST',
                url: miPath + 'controllers/loginController.php',
                data: {usuario: $scope.usuarioLogin, clave: $scope.passLogin},
            }).then(function successCallback(response) {
                if (response.data === 0) {
                    alert("No se encontro el usaurio")
                } else {
                    location.href = miPath;
                }
            }, function errorCallback(response) {
                console.error('Error')
            });

        }
    })


    /*
    *
    */

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


    /*
    *
    */

    app.controller('controladorBuscador', function ($scope, $http) {
        let operacion = 1;

        $scope.activarOperacion = function (op) {
            operacion = op
            var botonVenta = angular.element(document.querySelector('#operacion_1'));
            var botonAlquiler = angular.element(document.querySelector('#operacion_2'));

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


    /*
    *
    */

    app.controller('paginaMostrarResultados', function ($scope, $routeParams, $http) {
        let parametroOperacion = $routeParams.p1;
        let parametroProvincia = $routeParams.p2;
        let parametroPartido = $routeParams.p3;
        let parametroOrden = $routeParams.p4;

        // TODO: Ver que no se envien los parametros asi
        $scope.a = $routeParams.p1;
        $scope.b = $routeParams.p3;

        $scope.propiedades = [];
        $scope.op = ($routeParams.p1 == 1) ? 'Venta' : 'Alquiler';
        $http({
            method: 'POST',
            url: miPath + '/controllers/busquedaController.php',
            data: {
                pOperacion: parametroOperacion,
                pProvincia: parametroProvincia,
                pPartido: parametroPartido,
                pOrden: parametroOrden
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


    /*
    *
    */

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


    /*
    *
    */

    app.controller('vistaPropiedadController', function ($scope, $routeParams, $http) {
        $http({
            method: 'POST',
            url: miPath + '/controllers/traerUnaPropiedadController.php',
            data: {pPropiedad: $routeParams.p1},
        }).then(function successCallback(response) {
            $scope.datosPropiedad = response.data;
        }, function errorCallback(response) {
            console.error(response)
        });
    })

    /*
    *
    */

    app.controller('formAltaPropiedad', function ($scope, $http) {
        $scope.textoBoton = "Enviar"

        $scope.enviarInfoPropiedad = function () {

            $scope.textoBoton = "Enviando..."


            var form_data = new FormData();
            angular.forEach($scope.files, function (file) {
                form_data.append('file', file);
            });

            $http({
                method: 'POST',
                url: miPath + '/controllers/procesarAltaPropiedad2.php',
                data: form_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            }).then(function successCallback(response) {
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
                    url: miPath + '/controllers/procesarAltaPropiedad.php',
                    data: propiedad,
                }).then(function successCallback(response) {
                    // alert(response.data.descripcion);
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


</script>
