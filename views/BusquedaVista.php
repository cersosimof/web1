
<div class="contenedorColumnas container" style="height: 90vh">
    <div class="columnaUno" style="padding: 10px;">
        <h5 class="tituloPrincipal"> Filtros:</h5>

        <label for="filtroOperacion">Operacion</label>
        <ul id="filtroOperacion">
            <li>{{op}}</li>
        </ul>

        <label for="filtroPrecio">Precio</label>
        <ul id="filtroPrecio">
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/1">Ascendente</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/2">Descendente</a></li>
        </ul>
        <label for="filtroTamano"> Tamaño </label>
        <ul id="filtroTamano">
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/3">Ascendente</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/4">Descendente</a></li>
        </ul>
        <label for="filtroTipo"> Tipo (no funciona) </label>
        <ul id="filtrotipo">
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/3">CASA</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/4">DEPARTAMENTO</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/4">PH</a></li>
        </ul>

    </div>

    <div class="columnaDos" style="width: 100%; overflow: auto">
        <h4 class="tituloPrincipal" style="position: sticky; top: 0; background-color: white"> Resultados ({{cantidadResultados}}) </h4>
        <div id="contenedorDePropiedades" ng-if="cantidadResultados>0">
        <a class="cardInfoPropiedades" ng-repeat="propiedad in propiedades" href="#!/propiedad/{{propiedad.id}}">
            <div class="parteFoto">
                <img width="100%" height="100%" src="{{path}}imagenesPropiedades/{{propiedad.imagen}}">
            </div>
            <div class="parteInformacion">
            <h5 style="text-decoration: none;">{{propiedad.provincia}} - {{propiedad.partido}} - {{propiedad.m2}}m2</h5>
            <h6>Operacion: {{propiedad.operacion}}</h6>
            <h6 style="color: green; font-weight: bold;">$ {{propiedad.precio}}-</h6>
            <h6>Usuario: {{propiedad.usuario}}</h6>
            </div>
        </a>
        </div>
        <div ng-if="cantidadResultados==0"> No se encontraron resultados.</div>
    </div>
</div>

