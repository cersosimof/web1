
<div class="contenedorColumnas">
    <div class="columnaUno" style="padding: 10px;">
        <h5 class="tituloPrincipal"> Filtros:</h5>
        <p>Operacion: {{op}}.</p>

        <ul>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/1">PR ASC</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/2">PR DESC</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/3">M2 ASC</a></li>
            <li><a href="#!/busqueda/{{a}}/1/{{b}}/4">M2 DESC</a></li>

        </ul>
    </div>
    <div class="columnaDos" style="width: 100%">
        <h4 class="tituloPrincipal"> Resultados ({{cantidadResultados}}) </h4>
        <div id="contenedorDePropiedades" ng-if="cantidadResultados>0">
        <a class="cardInfoPropiedades" ng-repeat="propiedad in propiedades" href="#!/propiedad/{{propiedad.id}}">
            <div class="parteFoto">
                <img width="100%" height="100%" src="../web1/fotoMuestra.webp">
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

