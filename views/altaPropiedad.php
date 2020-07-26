<?php
session_start();
require_once("../models/ConnectDB.php");
$connect = new ConnectDB();
$partidos = $connect->traerPartidos();


if (!isset($_SESSION["usuario"])) {
    require_once("../views/login.php");
} else {




?>

<div class="pantallaLogin container" style="height: 80vh; display: flex">
    <div class="formIngreso" style="width: 60%">
        <h4 class="tituloPrincipal">Alta Propiedad</h4>
            <form>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="altaOperacion">Operacion</label>
                        <select class="custom-select" id="altaOperacion" ng-model="operacionAlta" required>
                            <option selected value=""> -- Seleccione Operacion -- </option>
                            <option selected value="1">Venta</option>
                            <option selected value="2">Alquiler</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="altaProvincia">Provincia</label>
                        <select class="custom-select" id="altaProvincia" ng-model="provinciaAlta" required>
                            <option selected value=""> -- Seleccione Provincia -- </option>
                            <option selected value="1">Buenos Aires</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="altaPartido">Partido:</label>

<!--                        <select ng-model="partidosModel" ng-options="partido.partido for partido in listaPartidos">-->
<!--                            <option value="" > -- Seleccione -- </option>-->
<!--                        </select>-->

                        <select class="form-control" id="altaPartido" ng-model="partidoAlta">
                            <option value="" selected="selected">--  Seleccione partido  --</option>
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
                        <select class="custom-select" id="altaTipo" ng-model="tipoAlta" required>
                            <option value=""> -- Seleccione Tipo -- </option>
                            <option value="Casa">Casa</option>
                            <option value="Departamento">Departamento</option>
                            <option value="PH">PH</option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="altaDireccion">Direccion</label>
                        <input type="text" class="form-control" id="altaDireccion" ng-model="direccionAlta" placeholder="Espora 1436 - Adrogue" required>
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
                            <input type="text" class="form-control" id="altaPrecio" ng-model="precioAlta">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault04">Tamaño</label>
                        <label class="sr-only" for="altaTamano">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">M2</div>
                            </div>
                            <input type="text" class="form-control" id="altaTamano" ng-model="tamanoAlta">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationDefault03">Descripcion</label>
                        <textarea type="text" style="height: 100px;" class="form-control" id="altaDescripcion" ng-model="descripcionAlta" required></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="file" file-input="files" />
                </div>

                <div class="btn btn-primary botonPrincipal" ng-click="enviarInfoPropiedad()" id="botonAltaPropiedad" style="margin-top: 40px">{{textoBoton}}</div>
            </form>
    </div>

    <div class="imagenIngreso" style="padding: 30px; width: 40%">
        <img src="../web1/altaPropiedad2.jpg" alt="" style="height: 100%">
    </div>



</div>

<?php
}
?>
