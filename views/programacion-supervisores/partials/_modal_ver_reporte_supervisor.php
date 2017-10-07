<div id="modal-ver-reporte" class="modal fade modal-wide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ver informe</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Información del puesto</h4>
                            </div>
                            <table class="table table-bordered table-striped table-condensed">
                                <tbody>
                                <tr><th>Codigo: </th><td id="nov-codigo-puesto"></td></tr>
                                <tr><th>Puesto: </th><td id="nov-nombre-puesto"></td></tr>
                                <tr><th>Cliente: </th><td id="nov-cliente-puesto"></td></tr>
                                <tr><th>Cuadrante: </th><td id="nov-cuadrante-puesto"></td></tr>
                                <tr><th>Zona: </th><td id="nov-zona-puesto"></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Novedad del recorrido</h4>
                            </div>
                            <div class="panel-body" id="novedad-recorrido">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Novedad del recurso</h4>
                    </div>
                    <div class="panel-body" id="novedad-recorrido-recurso">
                        <strong id="nombre-recurso">

                        </strong>
                        <div id="contenido-novedad-recurso">

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Novedad de elementos del puesto.</h4>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" col-sm-3>Elemento</th>
                                <th class="text-center">Observacion</th>
                            </tr>
                        </thead>
                        <tbody id="tbl-novedades-elementos-puesto">

                        </tbody>
                    </table>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Otras novedades.</h4>
                    </div>
                    <div class="panel-body" id="novedad-recorrido-otras">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>