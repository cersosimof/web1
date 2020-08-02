<?php
session_start();
include("../VariablesEntorno.php");

?>
<div class="contenedorColumnas container">
    <div class="columnaDos" style="width: 100%">
        <h5 class="tituloPrincipal">Propiedad</h5>
        <div style="display: flex;">
            <div style="width: 50%;">
                <?php
                if (Constants::ENTORNO == "dev") {
                    echo '<img src="../web1/imagenesPropiedades/{{datosPropiedad.imagen}}" style="width: 100%; height: auto">';
                } else {
                    echo '<img src="../imagenesPropiedades/{{datosPropiedad.imagen}}" style="width: 100%; height: auto">';
                }
                ?>
            </div>
            <div style="width: 50%;padding: 15px;display: flex;flex-direction: column;justify-content: space-around;">
                <p><b> {{datosPropiedad.tipo}} en {{datosPropiedad.operacion}} en {{datosPropiedad.provincia}} </b></p>
                <p>Partido: {{datosPropiedad.partido}}</p>
                <p>Direccion: {{datosPropiedad.direccion}}</p>
                <p>Tamaño: {{datosPropiedad.m2}} M2</p>
                <p>Costo Mes:<span style="color: green"> $ {{datosPropiedad.precio}} </span></p>
            </div>
        </div>
        <div style="padding: 15px;">
            <h5 class="tituloPrincipal" style="color: dimgrey">Descripcion Propiedad:</h5>
            <p>{{datosPropiedad.descripcion}}</p>
        </div>

        <div style="padding: 15px;">
            <h5 class="tituloPrincipal" style="color: dimgrey">Mensajes:</h5>
            <div style="display: flex; margin-bottom: 40px;">
                <div class="enviarNuevoMensaje" style="width: 50%;height: 30vh;display: flex;flex-direction: column;justify-content: space-between;">
                    <textarea rows="8" style="width: 100%; padding: 10px;" ng-model="textoComentario"></textarea>
                    <button class="botonPrincipal" ng-click="enviarComentario('<?php echo $_SESSION["usuario"]; ?>')">{{botonEnviarMensaje}}</button>
                </div>
                <div class="panelDeMensajes" style="width: 50%; height: 30vh; border: 1px solid black;" >
                    <div class="mensajeRecibido" style="overflow: auto;display: flex;flex-direction: column;height: 100%;">
                        <h6  class="efectoMensaje_{{key%2}}" ng-repeat="(key, mensaje) in listaMensajes | orderBy:mensaje.id:true" >
                            "<em>{{mensaje.mensaje}}</em>"<br><br>
                            <span style="display: flex;flex-direction: row; justify-content: flex-end">
                                {{mensaje.usuario}}. {{mensaje.fecha}}
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

