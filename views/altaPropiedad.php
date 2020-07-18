<?php
session_start();
require_once("../models/ConnectDB.php");
$connect = new ConnectDB();
$partidos = $connect->traerPartidos();

?>

<div class="pantallaLogin container" ng-controller="formAltaPropiedad">
    <div class="formIngreso">
        <h4 class="tituloPrincipal">Alta Propiedad</h4>
            <div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="altaOperacion">Operacion</label>
                        <select class="custom-select" id="altaOperacion" ng-model="operacion" required>
                            <option selected value="1">Venta</option>
                            <option selected value="2">Alquiler</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="altaProvincia">Provincia</label>
                        <select class="custom-select" id="altaProvincia" ng-model="provincia" required>
                            <option selected value="1">Buenos Aires</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="altaPartido">Partido:</label>
                        <select class="form-control" id="altaPartido" ng-model="partido">
                            <option value="0" selected="selected">Todos</option>
                            <?php
                            foreach ($partidos as $partido) {
                                echo "<option value='" . $partido["id"] . " '>" . $partido["partido"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="altaTipo">Tipo</label>
                        <select class="custom-select" id="altaTipo" ng-model="tipo" required>
                            <option selected value="Casa">Casa</option>
                            <option value="Casa">Departamento</option>
                            <option value="Casa">PH</option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="altaDireccion">Direccion</label>
                        <input type="text" class="form-control" id="altaDireccion" ng-model="direccion" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault04">Precio</label>
                        <label class="sr-only" for="altaPrecio">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control" id="altaPrecio" ng-model="precio">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault04">Tamaño</label>
                        <label class="sr-only" for="altaTamano">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">M2</div>
                            </div>
                            <input type="text" class="form-control" id="altaTamano" ng-model="tamano">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationDefault03">Descripcion</label>
                        <textarea type="text" style="height: 100px;" class="form-control" id="altaDescripcion" ng-model="descripcion" required></textarea>
                    </div>
                </div>

                <input type="text"  ng-model="usuario" >
<!--                ng-value="--><?php //echo $_SESSION["usuario"]; ?><!--"-->
                <button class="btn btn-primary botonPrincipal" ng-click="enviarInfoPropiedad()" >Cargar</button>
            </div>
    </div>
    <div class="imagenIngreso"></div>



</div>

