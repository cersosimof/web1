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
<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
<!--            </li>-->
            <?php if(isset($_SESSION["usuario"])){

            ?>
            <li class="nav-item">
                <a class="nav-link" href="#!/altaPropiedad">Publicar!</a>
            </li>
            <?php
            }
            ?>
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
                echo "" . "<a class=\"nav-link\" href=\"/web1/#!/login\">Iniciar sesion</a>";
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
                templateUrl : "controllers/homeController.php",
                controller : 'paginaPrincipalController'
            })
            .when("/altaUsuario", {
                templateUrl : "views/AltaUsuarioVista.php"
            })
            .when("/login", {
                templateUrl : "views/login.php"
            })
            .when("/altaPropiedad", {
                templateUrl : "controllers/altaPropiedadController.php",
                controller : 'formAltaPropiedad'
            })
            .when("/busqueda/:p1/:p2/:p3/:p4", {
                templateUrl : "views/BusquedaVista.php",
                controller : 'paginaMostrarResultados'
            })
    });



    app.controller('paginaPrincipalController', function ($scope) {
            // location.reload();
            console.log("Bienvenido")
        })


        app.controller('loginForm', function ($scope, $http) {
            $scope.titulo = "Bienvenido, ingrese los datos para ingresar, o registrese."
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



        app.controller('altaUsuario', function($scope, $http) {
            $scope.altaNuevoUsuario = function () {
                $http({
                    method: 'POST',
                    url: '/web1/controllers/AltaUsuarioController.php',
                    data: { nombre : $scope.nombreNuevoUsuario,
                            apellido : $scope.apellidoNuevoUsuario,
                            usuario : $scope.usuarioNuevoUsuario,
                            correo : $scope.correoNuevoUsuario,
                            claveUno : $scope.clave1NuevoUsuario,
                            claveDos : $scope.clave2NuevoUsuario,
                            },
                }).then(function successCallback(response) {
                    if(response.data.estado == "OK"){
                        alert(response.data.descripcion)
                        location.href = "/web1/"
                    } else {
                        alert(response.data.descripcion)
                    }
                }, function errorCallback(response) {
                    console.error(response)
                });
            }
        })


    app.controller('controladorBuscador', function($scope, $http){
        let operacion = 1;

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
            location.href = '#!/busqueda/'+ operacion +'/'+$scope.provinciaABuscar+'/'+$scope.partidoABuscar+'/0';
        }

    })

    app.controller('paginaMostrarResultados', function($scope, $routeParams, $http) {
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

        //Subida de imagenes
        app.directive("fileInput", function($parse){
            return{
                link: function($scope, element, attrs){
                    element.on("change", function(event){
                        var files = event.target.files;
                        console.log(files[0].name);
                        $parse(attrs.fileInput).assign($scope, element[0].files);
                        $scope.$apply();
                    });
                }
            }
        });


    /*
        Alta Propiedad
     */
        app.controller('formAltaPropiedad', function($scope, $http) {

            $scope.enviarInfoPropiedad = function () {

                //Codigo foto
                var form_data = new FormData();
                angular.forEach($scope.files, function(file){
                    form_data.append('file', file);
                });

                // var propiedad =
                //     {
                //         operacion : $scope.operacionAlta,
                //         provincia : $scope.provinciaAlta,
                //         partido : $scope.partidoAlta,
                //         tipo : $scope.tipoAlta,
                //         direccion : $scope.direccionAlta,
                //         precio : $scope.precioAlta,
                //         tamano : $scope.tamanoAlta,
                //         descripcion : $scope.descripcionAlta,
                //     }

                // alert(response.data.descripcion);
                // if(response.data.estado == "OK"){
                //     location.reload();
                // }
                // });
                // codigo foto
                // $http({
                //     method: 'POST',
                //     url: '/web1/controllers/procesarAltaPropiedad.php',
                //     data: propiedad,
                // }).then(function successCallback(response) {
                //     console.log(response);
                //     alert(response.data.descripcion);
                //     if(response.data.id != 0){

                //     }
                // }, function errorCallback(response) {
                //     console.error(response)
                // });


                $http({
                    method : 'POST',
                    url : '/web1/controllers/procesarAltaPropiedad2.php',
                    data: form_data,
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function successCallback(response) {
                    var propiedad =
                        {
                            operacion : $scope.operacionAlta,
                            provincia : $scope.provinciaAlta,
                            partido : $scope.partidoAlta,
                            tipo : $scope.tipoAlta,
                            direccion : $scope.direccionAlta,
                            precio : $scope.precioAlta,
                            tamano : $scope.tamanoAlta,
                            descripcion : $scope.descripcionAlta,
                            foto : response.data
                        }


                        $http({
                            method: 'POST',
                            url: '/web1/controllers/procesarAltaPropiedad.php',
                            data: propiedad,
                        }).then(function successCallback(response) {
                            console.log(response);
                            alert(response.data.descripcion);
                            if(response.data.id != 0){
                                alert(response.data.descripcion)
                            }
                            // location.reload();
                        }, function errorCallback(response) {
                            console.error(response)
                        });


                }, function errorCallback(response) {
                    console.error(response)
                });


            }
        })


</script>
