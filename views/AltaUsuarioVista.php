

    <div class="pantallaLogin container">
      <div class="formIngreso">
        <h4 class="tituloPrincipal">Alta usuario</h4>
        <form method="post" action="/altaPropiedad" ng-controller="altaUsuario">

            <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" />
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" name="apellido" />
          </div>

          <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" />
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="text" class="form-control" name="correo" />
          </div>

          <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control" name="clave" />
          </div>
<!--          <div class="form-group">-->
<!--            <label for="pass">Repetir</label>-->
<!--            <input type="password" class="form-control" id="pass" />-->
<!--          </div>-->

          <button type="submit" class="btn btn-primary botonPrincipal">Aceptar</button>
        </form>
      </div>
      <div class="imagenIngreso"></div>


    </div>

