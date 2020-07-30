<?php
require_once("../models/ConnectDB.php");
require_once ("../Util/Utils.php");

$connect = new ConnectDB();
$d = $connect->traerTodasLasPropiedadesADM();



?>

<?php session_start();
require_once("../VariablesEntorno.php");
?>


<!doctype html>
<html ng-app="admin" ng-controller="adminController">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
</head>
<body style="width: 100%; background-color: black">
<input type="hidden" value="<?php echo Constants::ENTORNO; ?>" id="idEntorno">

<ul class="nav">
<h2 style="text-align: center; color: #F8F8F8">ADMINISTRADOR PROPIEDADES!</h2>
</ul>

<h4 style="color: #F8F8F8; padding: 15px 30px; border-bottom: 1px solid white; padding-bottom: 3px;">PROPIEDADES</h4>
<div style="height: 60vh; overflow: auto; padding: 0px 30px;">
    <table class="table" id="tablaPropiedadesAdministrador">
        <thead class="thead-dark">
        <tr>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">ID</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Operacion</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Provincia</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Partido</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Direccion</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Usuario</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Precio</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">M2</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">Tipo</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">MODIFICAR</th>
            <th scope="col" style="position: sticky; top: 0; z-index: 100">ELIMINAR</th>

        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($d as $propiedad) {
        ?>
        <tr>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["id"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center; "><?php echo $propiedad["operacion"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["provincia"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["partido"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["direccion"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["usuario"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["precio"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["m2"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><?php echo $propiedad["tipo"]; ?></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><button type="button" class="btn btn-warning" ng-onclick="modificarPropiedad('<?php echo $propiedad["id"]; ?>')">MODIFICAR</button></td>
            <td style="background-color: #F8F8F8; padding: 1px; vertical-align: middle; text-align: center;"><button type="button" class="btn btn-danger" ng-onclick="borrarPropiedad('<?php echo $propiedad["id"]; ?>')">ELIMINAR</button></td>
        </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
</div>

<!--CUERPO -->
<div class="container">
    <div ng-view></div>
</div>
</body>
</html>


<script>
    var admin = angular.module("admin", ["ngRoute"]);

    admin.controller("adminController", function ($scope, $routeParams, $http) {
        console.log("HOLA SOY ADMIN")
    })

</script>