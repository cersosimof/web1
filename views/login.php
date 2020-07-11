<div class="contenedorLogin">
    <div class="loginForm">
        <div class="form-signin" ng-controller="loginForm">
            <div class="text-center mb-4">

                <p style="color: white">{{titulo}}</p>
            </div>

            <div class="form-label-group">
                <label for="inputEmail" style="color: white">Nombre de Usuario:</label>
                <input type="text" id="usuarioLogin" class="form-control" placeholder="Usuario" ng-model="usuarioLogin" >
            </div>

            <div class="form-label-group">
                <label for="inputPassword" style="color: white">Contraseña</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" ng-model="passLogin">
            </div>

            <button class="btn btn-lg btn-primary btn-block" ng-click="enviarDatosLogin()">Ingresar</button>

            <a href="/web1/#!/altaUsuario" class="mb-3 text-muted text-center"
               style="display: flex;flex-direction: row-reverse;justify-content: end;">Registrarme</a>
        </div>
    </div>
</div>