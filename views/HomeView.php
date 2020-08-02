<?php
include_once("../VariablesEntorno.php");
?>

<div class="contenedorColumnas container" >
    <div class="columnaDos" style="width: 100%">
        <div class="jumbotron" ng-controller="controladorBuscador">
            <h1 class="display-4">Buscador:</h1>
            <p class="lead">Ingrese los parametros para realizar una busqueda.</p>
            <hr class="my-4">

            <div style="display: flex;flex-direction: row;width: 100%;justify-content: space-around;height: 38px;align-items: center;margin-top: 35px;">
                <div class="btn-group elementoBuscadorPrincipal" role="group" aria-label="Basic example" ng-init="activarOperacion(1)" style="flex-direction: row">
                    <div class="btn btn-secondary selectOperacionBotones" ng-click="activarOperacion(1)" id="operacion_1">Venta</div>
                    <div class="btn btn-secondary selectOperacionBotones" ng-click="activarOperacion(2)" id="operacion_2">Alquiler</div>
                </div>

                <div class="form-group elementoBuscadorPrincipal" style="margin-bottom: 0px;">
                    <label for="selectProvincia">Provincia:</label>
                    <select class="form-control" id="selectProvincia" name="provincia" style="height: 35px" ng-model="provinciaABuscar">
                        <option value="">--  Seleccione  --</option>
                        <option value="1">Buenos Aires</option>
                    </select>
                </div>

                <div class="form-group elementoBuscadorPrincipal" style="margin-bottom: 0px;">
                    <label for="selectProvincia">Partido:</label>
                    <select class="form-control" id="selectProvincia" name="partido" style="height: 35px" ng-model="partidoABuscar">
                        <option value="" selected="selected">--  Seleccione  --</option>
                        <option value="0" selected="selected">Todos</option>
                        <?php
                            foreach ($partidos as $partido) {
                                echo "<option value='" . $partido["id"] . "'>" . $partido["partido"] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="elementoBuscadorPrincipal">
                    <div  class="btn btn-primary btn-lg botonPrincipal" ng-click="enviarBusqueda()" style="height: 36px; padding: 7px 12px; padding-top: 4px; font-size: 16px;">Buscar!</div>
                </div>

            </div>
        </div>

        <h4 class="tituloPrincipal">Ultimos ingresos</h4>

        <div class="contenedorCards">
            <a <a href="#!/propiedad/{{propiedad.id}}" class="cardProducto" ng-repeat="propiedad in cuatroPropiedades">
                <div class="card" style="width: 18rem;">
                    <?php
                        if (Constants::ENTORNO == "dev") {
                            echo '<img src="../web1/imagenesPropiedades/{{propiedad.imagen}}" class="card-img-top" style="height: 170px;">';
                        } else {
                            echo '<img src="../imagenesPropiedades/{{propiedad.imagen}}" class="card-img-top" style="height: 170px;">';
                        }
                    ?>
                    <div class="card-body" style="padding: 6px; width: 100%">
                        <h5 class="card-title">{{propiedad.operacion}} - {{propiedad.partido}}</h5>
                        <h6 class="sacarEfectos">Direccion: {{propiedad.direccion}}</h6>
                        <h6>Tamaño: {{propiedad.m2}} M2</h6>
                        <h6 style="color: green">Costo Mes:$ {{propiedad.precio}}.-</h6>
                    </div>
                </div>
            </a>

        </div>
    </div>
</div>
<!---->
<!--<form ng-action=""></form>-->