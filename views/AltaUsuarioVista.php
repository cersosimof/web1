<div class="pantallaLogin container" style="height: 80vh">
    <div class="formIngreso">
        <h4 class="tituloPrincipal">Alta usuario</h4>
        <form>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" ng-model="nombreNuevoUsuario" required/>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" ng-model="apellidoNuevoUsuario" required/>
            </div>

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" ng-model="usuarioNuevoUsuario" required/>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" ng-model="correoNuevoUsuario" required/>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" class="form-control" ng-model="clave1NuevoUsuario" required/>
            </div>
            <div class="form-group">
                <label for="pass">Repetir</label>
                <input type="password" class="form-control" ng-model="clave2NuevoUsuario" required/>
            </div>
            <button type="submit" class="btn btn-primary botonPrincipal" ng-click="altaNuevoUsuario()">Aceptar</button>
        </form>
    </div>
    <div class="imagenIngreso" style="padding: 30px">
        <img src="../web1/altaPropiedad.jpg" alt="" style="height: 100%">
    </div>

</div>

