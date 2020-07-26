<?php
include("../VariablesEntorno.php");

?>
<div class="contenedorColumnas">
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
    </div>
</div>

