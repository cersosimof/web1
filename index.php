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
                <a class="nav-link" href="/web1/#!/altaPropiedad">Publicar!</a>
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
    app.config(function($routeProvider) {
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

        })


        app.controller('formAltaPropiedad', function($scope, $http) {
            $scope.usuario = "2324234"
            $scope.operacion = 1;
            // $scope.enviarInfoPropiedad = function () {
            //     // $http({
            //     //     method: 'POST',
            //     //     url: '/web1/controllers/altaPropiedadController.php',
            //     //     data: { operacion : $scope.operacion,
            //     //         provincia : $scope.provincia,
            //     //         partido : $scope.partido,
            //     //         tipo : $scope.tipo,
            //     //         direccion : $scope.direccion,
            //     //         precio : $scope.precio,
            //     //         tamano : $scope.tamano,
            //     //         descripcion : $scope.descripcion,
            //     //         usuario : $scope.usuario
            //     //     },
            //     // }).then(function successCallback(response) {
            //     //     console.log(response)
            //     // }, function errorCallback(response) {
            //     //     console.error('Error')
            //     // });
            // }
        })


</script>
