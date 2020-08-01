<?php
session_start();
require_once("../models/ConnectDB.php");
require_once("../Util/Utils.php");

$connect = new ConnectDB();
$d = $connect->traerTodasLasPropiedadesADM();

$u = $connect->traerTodosLosUsuariosADM();

require_once("../VariablesEntorno.php");
?>


<div style="display: flex; padding: 15px 0px">
    <div style="width: 60%">
        <div id="administradorPropiedades" style="height: 75vh; overflow: auto; padding: 0px 30px;">
            <table class="table" id="tablaPropiedadesAdministrador">
                <thead class="thead-dark">
                <tr>
                    <th colspan="9" scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">PROPIEDADES</th>
                </tr>
                <tr>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">ID</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Operacion</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Provincia</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Partido</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Direccion</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Usuario</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Precio</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">M2</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Tipo</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($d as $propiedad) {
                    ?>
                    <tr class="resaltarRow" ng-click="interactuar(1, <?php echo $propiedad["id"]; ?>)">
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["id"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer "><?php echo $propiedad["operacion"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["provincia"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["partido"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["direccion"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["usuario"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["precio"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["m2"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $propiedad["tipo"]; ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>


            <table class="table" id="tablaPropiedadesAdministrador">
                <thead class="thead-dark">
                <tr>
                    <th colspan="6" scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">USUARIOS</th>
                </tr>
                <tr>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">ID</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Nombre</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Apellido</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Usuario</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Correo</th>
                    <th scope="col" style="position: sticky; top: 0; z-index: 100; font-size: 11px">Clave</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($u as $usuario) {
                    ?>
                    <tr class="resaltarRow" ng-click="interactuar(2, <?php echo $usuario["id"]; ?>)">
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $usuario["id"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer "><?php echo $usuario["nombre"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $usuario["apellido"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $usuario["usuario"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $usuario["correo"]; ?></td>
                        <td style="padding: 1px; vertical-align: middle; text-align: center; font-size: 11px;cursor: pointer"><?php echo $usuario["clave"]; ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>

    <div style="width: 40%; padding: 4px 20px">
        <div ng-if="productoVisible == 0"></div>
        <div style="background-color: beige" ng-if="productoVisible == 1">
            <h4 class="tituloPrincipal">PROPIEDAD</h4>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <label style="font-size: 10px">Operacion</label>
                        <select ng-model="myvar" ng-options="opt.label for opt in myoptions" class="form-control"
                                style="font-size: 10px">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label style="font-size: 10px">Provincia</label>
                        <select ng-model="provincias" ng-options="opt.label for opt in arrayProvincias"
                                class="form-control" style="font-size: 10px">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label style="font-size: 10px">Partido:</label>
                        <select ng-model="partidos" ng-options="opt.label for opt in arrayPartido" class="form-control"
                                style="font-size: 10px">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 10px">Tipo</label>
                        <select ng-model="tipos" ng-options="opt.label for opt in arrayTipo" class="form-control"
                                style="font-size: 10px">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12">
                        <label style="font-size: 10px">Direccion</label>
                        <input type="text" class="form-control" id="altaDireccion" ng-model="direccion"
                               style="font-size: 10px">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label style="font-size: 10px">Precio</label>
                        <label class="sr-only" for="altaPrecio">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="font-size: 10px">$</div>
                            </div>
                            <input type="text" class="form-control" id="altaPrecio" ng-model="precio"
                                   style="font-size: 10px">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 10px">Tamaño</label>
                        <label class="sr-only" for="altaTamano">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="font-size: 10px">M2</div>
                            </div>
                            <input type="text" class="form-control" id="altaTamano" ng-model="tamano"
                                   style="font-size: 10px">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12">
                        <label style="font-size: 10px">Descripcion</label>
                        <textarea type="text" style="height: 100px; font-size: 10px" class="form-control"
                                  id="altaDescripcion" ng-model="descripcion" style="font-size: 10px"></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="file" file-input="files" style="font-size: 10px"/>
                </div>
                <br>
                <div style="display: flex;flex-direction: row;justify-content: space-around;">
                    <button scope="col" class="btn btn-primary" style="width: 40%; font-size: 10px">MODIFICAR</button>
                    <button scope="col" class="btn btn-danger" style="width: 40%; font-size: 10px"
                            ng-click="eliminarPropiedad()">ELIMINAR
                    </button>
                </div>
            </form>
        </div>
        <div ng-if="productoVisible == 2" style="background-color: darkseagreen">
            <h4 class="tituloPrincipal">USUARIO</h4>
            <form>
                <div class="form-group">
                    <label for="nombre" style="font-size: 10px">Nombre</label>
                    <input type="text" class="form-control" ng-model="nombre" style="font-size: 10px"/>
                </div>
                <div class="form-group">
                    <label for="apellido" style="font-size: 10px">Apellido</label>
                    <input type="text" class="form-control" ng-model="apellido" style="font-size: 10px"/>
                </div>

                <div class="form-group">
                    <label for="usuario" style="font-size: 10px">Usuario</label>
                    <input type="text" class="form-control" ng-model="usuario" style="font-size: 10px"/>
                </div>
                <div class="form-group">
                    <label for="correo" style="font-size: 10px">Correo</label>
                    <input type="text" class="form-control" ng-model="correo" style="font-size: 10px"/>
                </div>

                <div class="form-group">
                    <label for="pass" style="font-size: 10px">Contraseña</label>
                    <input type="password" class="form-control" ng-model="clave" style="font-size: 10px"/>
                </div>

                <div style="display: flex;flex-direction: row;justify-content: space-around;">
                    <button scope="col" class="btn btn-primary" style="width: 40%; font-size: 10px">MODIFICAR</button>
                    <button scope="col" class="btn btn-danger" style="width: 40%; font-size: 10px"
                            ng-click="eliminarUsuario()">ELIMINAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



