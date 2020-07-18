


      <div class="contenedorColumnas">
        <div class="columnaUno">
          sdfs
        </div>
        <div class="columnaDos">
            <div class="jumbotron" ng-controller="controladorBuscador">
                <h1 class="display-4">Buscador:</h1>
                <p class="lead">Ingrese los parametros para realizar una busqueda.</p>
                <hr class="my-4">

                <form action="tuvieja" method="get" style="display: flex;flex-direction: row;width: 100%;justify-content: space-around;height: 38px;align-items: center;margin-top: 35px;">
<!--                    BOTON DE ALQUILA O VENDE-->
                <div style="display: flex; flex-direction: column">
                    <label for="selectProvincia">Operacion:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="operacion" value="1" id="radioVenta" checked>
                        <label class="form-check-label" for="radioVenta">
                            Venta
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="operacion" value="2" id="radioAlquiler" >
                        <label class="form-check-label" for="radioAlquiler">
                            Alquiler
                        </label>
                    </div>
                </div>
<!--                    <div class="btn-group" role="group" aria-label="Basic example" style="padding-top: 11px" ng-init="activarOperacion(1)" name="operacion">-->
<!--                        <div class="btn btn-secondary" ng-click="activarOperacion(1)" id="operacion_1" name="operacion">Venta</div>-->
<!--                        <div class="btn btn-secondary" ng-click="activarOperacion(2)" id="operacion_2" name="operacion">Alquiler</div>-->
<!--                    </div>-->

<!--                    SELECT PROVINCIA-->
                    <div class="form-group" >
                        <label for="selectProvincia">Provincia:</label>
                        <select class="form-control" id="selectProvincia" name="provincia">
                            <option value="1">Buenos Aires</option>
                        </select>
                    </div>

<!--                    SELECT PARTIDO-->
                    <div class="form-group">
                        <label for="selectProvincia">Partido:</label>
                        <select class="form-control" id="selectProvincia" name="partido">
                            <option value="0" selected="selected">Todos</option>
                            <?php
                            foreach ($partidos as $partido) {
                            echo "<option value='" . $partido["id"] . "'>" . $partido["partido"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div style="padding-top: 11px">
                        <button type="submit" class="btn btn-primary btn-lg" href="#" role="button" style="height: 38px; padding: 6px 12px; padding-top: 4px;">Buscar!</button>
                    <!--                        <a class="btn btn-primary btn-lg" href="#" role="button" style="height: 38px; padding: 6px 12px; padding-top: 4px;" ng-click="enviarBusqueda()">Buscar</a>-->
                    </div>

                </form>


            </div>
            <div class="contenedorCards">
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
                
                <div class="cardProducto">
                    <div class="card" style="width: 18rem;">
                        <img src="../casa.webp" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        
                        </div>
                    </div>
                </div>
            </div>    

            
        </div>
      </div>
