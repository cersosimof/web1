<?php
include("../VariablesEntorno.php");
?>


<div class="contenedorColumnas container" style="height: 85vh;">
    <div class="columnaUno" style="padding: 10px; width: 50%">
        <div class="contenedorLogin">
            <div class="loginForm">
                <div>
                    <div class="text-center mb-4">
                        <p style="color: darkolivegreen">{{mensaje}}</p>
                    </div>

                    <div class="form-label-group">
                        <label for="inputEmail">Nombre de Usuario:</label>
                        <input type="text" id="usuarioLogin" class="form-control" placeholder="Usuario" ng-model="usuarioLogin" >
                    </div>

                    <div class="form-label-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" ng-model="passLogin">
                    </div>

                    <button class="btn btn-lg btn-primary btn-block botonPrincipal" style="height: 35px; margin: 15px 0px; padding-top: 2px;"  ng-click="enviarDatosLogin()">Ingresar</button>

                    <a href="/web1/#!/altaUsuario" class="mb-3 text-muted text-center"
                       style="display: flex;flex-direction: row-reverse;justify-content: end;">Registrarme</a>
                </div>
            </div>
        </div>
    </div>

    <div class="columnaDos" style="width: 50%">
        <?php
        if(Constants::ENTORNO == "dev"){
            echo '<img src="../web1/key.jpg" style="width: auto; height: 100%">';
        }else{
            echo '<img src="../key.jpg" style="width: auto; height: 100%">';
        }
        ?>
    </div>
</div>

