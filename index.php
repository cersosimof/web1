<?php session_start();?>


<!doctype html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" style="padding: 0px 25px">
    <a class="navbar-brand" href="#">ALQUILERES</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#!/altaPropiedad">Publicar!</a>
            </li>
<!--            --><?php //if(isset($_SESSION["usuario"])){ ?>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/web1/controllers/close_session.php">Cerrar sesion</a>-->
<!--            </li>-->
<!--            --><?php //} else { ?>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/web1/#!/login">Iniciar sesion</a>-->
<!--            </li>-->
<!--            --><?php //} ?>
        </ul>
        <span class="navbar-text" style="display: contents;">
            <?php
            if(isset($_SESSION["usuario"])){
                echo "Bienvenido " . $_SESSION["usuario"] . "!" . "<a class=\"nav-link\" href=\"/web1/controllers/close_session.php\">Cerrar sesion</a>";
            } else {
                echo "ANONIMO" . "<a class=\"nav-link\" href=\"/web1/#!/login\">Iniciar sesion</a>";
            }; ?>
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
    app.config(   function($routeProvider) {
        $routeProvider
            .when("/", {
                templateUrl : "controllers/homeController.php"
            })
            .when("/altaUsuario", {
                templateUrl : "views/AltaUsuarioVista.php"
            })
            .when("/login", {
                templateUrl : "views/login.php"
            })
            .when("/altaPropiedad", {
                templateUrl : "controllers/altaPropiedadController.php"
            })
            .when("/busqueda/:p1/:p2/:p3/:p4", {
                templateUrl : "views/BusquedaVista.php",
                controller : 'paginaMostrarResultados'
            })
    });


        app.controller('loginForm', function ($scope, $http) {
            $scope.titulo = "Bienvenido, soy el titulo"
            $scope.enviarDatosLogin = function () {
                $http({
                    method: 'POST',
                    url: '/web1/controllers/loginController.php',
                    data: { usuario : $scope.usuarioLogin, clave : $scope.passLogin },
                }).then(function successCallback(response) {
                    if(response.data===0){
                        alert("No se encontro el usaurio")
                    } else {
                        location.href = "/web1/"
                    }
                }, function errorCallback(response) {
                    console.error('Error')
                });

            }
        })



        app.controller('altaUsuario', function($scope) {
            $scope.saludar = function () {
                alert('saludar')
            }
        })

    app.controller('controladorBuscador', function($scope, $http){
        let operacion = 1;
        let provincia = 1;
        let partido = 0;

        $scope.activarOperacion = function (op) {
            operacion = op
            var botonVenta = angular.element( document.querySelector( '#operacion_1' ) );
            var botonAlquiler = angular.element( document.querySelector( '#operacion_2' ) );

            botonVenta.removeClass('botonSeleccionado');
            botonAlquiler.removeClass('botonSeleccionado');

            if(operacion == 1){
                botonVenta.addClass('botonSeleccionado');
            } else {
                botonAlquiler.addClass('botonSeleccionado');
            }
        }



        $scope.enviarBusqueda = function (){

            location.href = '#!/busqueda/'+ provincia +'/'+$scope.provinciaABuscar+'/'+$scope.partidoABuscar+'/0';
        }
        //     $http({
        //         method: 'POST',
        //         url: '/web1/controllers/busquedaController.php',
        //         data: { op : operacion, provincia : $scope.provinciaABuscar, partido : $scope.partidoABuscar },
        //     }).then(function successCallback(response) {
        //             console.log(response)
        //     }, function errorCallback(response) {
        //         console.error('Error')
        //     });
        // }
    })

    app.controller('paginaMostrarResultados', function($scope, $routeParams, $http) {
        let parametroOperacion = $routeParams.p1;
        let parametroProvincia = $routeParams.p2;
        let parametroPartido = $routeParams.p3;
        let parametroOrden = $routeParams.p4;

        // ver esto
        $scope.a = $routeParams.p1;
        $scope.b = $routeParams.p3;

        $scope.propiedades = [];
        $scope.op = ($routeParams.p1 == 1) ? 'Venta' : 'Alquiler';
        $http({
            method: 'POST',
            url: '/web1/controllers/busquedaController.php',
            data: { pOperacion : parametroOperacion, pProvincia : parametroProvincia, pPartido : parametroPartido, pOrden : parametroOrden },
        }).then(function successCallback(response) {
            response.data.forEach((x) => {
                $scope.propiedades.push(x)
            })
            $scope.cantidadResultados = $scope.propiedades.length;
        }, function errorCallback(response) {
            console.error(response)
        });

    })

        app.controller('formAltaPropiedad', function($scope, $http) {

            $scope.enviarInfoPropiedad = function () {

                var propiedad =
                    {
                        operacion : $scope.operacionAlta,
                        provincia : $scope.provinciaAlta,
                        partido : $scope.partidoAlta,
                        tipo : $scope.tipoAlta,
                        direccion : $scope.direccionAlta,
                        precio : $scope.precioAlta,
                        tamano : $scope.tamanoAlta,
                        descripcion : $scope.descripcionAlta
                    }

                $http({
                    method: 'POST',
                    url: '/web1/controllers/procesarAltaPropiedad.php',
                    data: propiedad,
                }).then(function successCallback(response) {
                    if(response.data == 1) {
                        alert("El registro se cargo correctamente");
                        location.reload();
                    } else {
                        alert("Problema al cargar el registro")
                    }
                }, function errorCallback(response) {
                    console.error('Error')
                });
            }
        })


</script>
