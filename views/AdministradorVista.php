<?php
session_start();
if($_SESSION["usuario"] != 'cersosimof') {
    echo '<div style="display: flex;flex-direction: row;justify-content: center;"> <span style="display: flex; padding-top: 70px;">Contenido no disponible...&nbsp;&nbsp;  <br><a href="#!/"> Volver a Home </a></span> <span style="font-size: 100px; padding: 0px 40px">☹️</span> </div>';
} else {

require_once("../models/ConnectDB.php");
require_once("../Util/Utils.php");

$connect = new ConnectDB();
$d = $connect->traerTodasLasPropiedadesADM();
$u = $connect->traerTodosLosUsuariosADM();

require_once("../VariablesEntorno.php");
?>


<div style="display: flex; padding: 15px 0px">
    <div style="width: 70%; height: 100%">
        <div id="administradorPropiedades" style="height: 90vh; overflow: auto; padding: 0px 30px;">
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
                    <tr ng-class="<?php echo $propiedad["id"]; ?> == idVisible && productoVisible == 1 ? 'fondoBeige resaltarRow' : 'resaltarRow'"  ng-click="interactuar(1, <?php echo $propiedad["id"]; ?>)">
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

            <table class="table" id="tablaPropiedadesAdministrador" >
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
                    <tr ng-class="<?php echo $usuario["id"]; ?> == idVisible && productoVisible == 2 ? 'fondoVerde resaltarRow' : 'resaltarRow'"  ng-click="interactuar(2, <?php echo $usuario["id"]; ?>)">
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

    <div style="width: 30%; padding: 0px 20px; height: 100%" id="panelB" >
            <div ng-if="productoVisible == 15" style="width: 40%;padding: 4px 20px;display: flex;flex-direction: row;align-items: center;width: 100%; height: 100%;justify-content: center;">
                <h4>Espere por favor...</h4>
            </div>
        <div ng-if="productoVisible == 0">
            <div class="jumbotron" style="height: 100%">
                <h1 class="display-4">Hola!</h1>
                <p class="lead">Al hacer click en una propiedad o usuario, podras modificarlos o borrarlos.</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="#!/" role="button">Ir Buscador</a>
            </div>
        </div>
        <div style="background-color: beige" ng-if="productoVisible == 1" id="propiedadesListaAdministrador">
            <h4 class="tituloPrincipal">PROPIEDAD {{id}}</h4>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <label style="font-size: 10px">Operacion</label>
                        <select ng-model="operacionUpdate" ng-options="opt.label for opt in myoptions" class="form-control" style="font-size: 10px" ng-change="change(operacionUpdate, 'operacionUpdate')">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label style="font-size: 10px">Provincia</label>
                        <select ng-model="provinciaUpdate" ng-options="opt.label for opt in arrayProvincias" class="form-control" style="font-size: 10px"  ng-change="change(provinciaUpdate, 'provinciaUpdate')">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <label style="font-size: 10px">Partido:</label>
                        <select ng-model="partidoUpdate" ng-options="opt.label for opt in arrayPartido" class="form-control" style="font-size: 10px" ng-change="change(partidoUpdate, 'partidoUpdate')">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 10px">Tipo</label>
                        <select ng-model="tipoUpdate" ng-options="opt.label for opt in arrayTipo" class="form-control" style="font-size: 10px" ng-change="change(tipoUpdate, 'tipoUpdate')">
                            <option value="">-- choose an option --</option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12">
                        <label style="font-size: 10px">Direccion</label>
                        <input type="text" class="form-control" id="altaDireccion" ng-model="direccionUpdate" style="font-size: 10px" ng-change="change(direccionUpdate, 'direccionUpdate')">
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
                            <input type="text" class="form-control" id="altaPrecio" ng-model="precioUpdate" style="font-size: 10px" ng-change="change(precioUpdate, 'precioUpdate')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size: 10px">Tamaño</label>
                        <label class="sr-only" for="altaTamano">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="font-size: 10px">M2</div>
                            </div>
                            <input type="text" class="form-control" id="altaTamano" ng-model="tamanoUpdate" style="font-size: 10px" ng-change="change(tamanoUpdate, 'tamanoUpdate')">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12">
                        <label style="font-size: 10px">Descripcion</label>
                        <textarea type="text" style="height: 100px; font-size: 10px" class="form-control" id="altaDescripcion" ng-model="descripcionUpdate" style="font-size: 10px" ng-change="change(descripcionUpdate, 'descripcionUpdate')"></textarea>
                    </div>
                </div>

                <div style="height: 200px; padding: 10px;">
                    <div style="height: 100%">
                        <?php
                        if (Constants::ENTORNO == "dev") {
                            echo '<img src="../web1/imagenesPropiedades/{{fotoUpdateParaMostrar}}" class="card-img-top" style="height: 100%; width: auto; border: 1px solid black">';
                        } else {
                            echo '<img src="../imagenesPropiedades/{{fotoUpdateParaMostrar}}" class="card-img-top" style="height: 100%; width: auto; border: 1px solid black">';
                        }
                        ?>
                    </div>
                    <div style="display: flex">
                        <label for="">Reset Foto?</label>
                        <input type="checkbox" ng-model="fotoUpdate" ng-change="change(fotoUpdate, 'fotoUpdate')" style="margin-top: 5px; margin-left: 5px;">
                    </div>
                </div>
                
                <br>
                <div style="display: flex;flex-direction: row;justify-content: space-around;">
                    <button scope="col" class="btn btn-primary" style="width: 40%; font-size: 10px"  ng-click="modificarPropiedad()">MODIFICAR</button>
                    <button scope="col" class="btn btn-danger" style="width: 40%; font-size: 10px"
                            ng-click="eliminarPropiedad()">ELIMINAR
                    </button>
                </div>
            </form>
        </div>
        <div ng-if="productoVisible == 2" style="background-color: darkseagreen">
            <h4 class="tituloPrincipal">USUARIO {{id}}</h4>
            <form>
                <div class="form-group">
                    <label for="nombre" style="font-size: 10px">Nombre</label>
                    <input type="text" class="form-control" ng-model="nombreUpdate" style="font-size: 10px" ng-change="change_(nombreUpdate, 'nombreUpdate')"/>
                </div>
                <div class="form-group">
                    <label for="apellido" style="font-size: 10px">Apellido</label>
                    <input type="text" class="form-control" ng-model="apellidoUpdate" style="font-size: 10px" ng-change="change_(apellidoUpdate, 'apellidoUpdate')"/>
                </div>

                <div class="form-group">
                    <label for="usuario" style="font-size: 10px">Usuario</label>
                    <input type="text" class="form-control" ng-model="usuarioUpdate" style="font-size: 10px" ng-change="change_(usuarioUpdate, 'usuarioUpdate')"/>
                </div>
                <div class="form-group">
                    <label for="correo" style="font-size: 10px">Correo</label>
                    <input type="text" class="form-control" ng-model="correoUpdate" style="font-size: 10px" ng-change="change_(correoUpdate, 'correoUpdate')"/>
                </div>

                <div class="form-group">
                    <label for="pass" style="font-size: 10px">Contraseña</label>
                    <input type="password" class="form-control" ng-model="claveUpdate" style="font-size: 10px" ng-change="change_(claveUpdate, 'claveUpdate')"/>
                </div>

                <div style="display: flex;flex-direction: row;justify-content: space-around;">
                    <button scope="col" class="btn btn-primary" style="width: 40%; font-size: 10px" ng-click="modificarUsuario()">MODIFICAR</button>
                    <button scope="col" class="btn btn-danger" style="width: 40%; font-size: 10px" ng-click="eliminarUsuario()">ELIMINAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}
?>


