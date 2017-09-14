<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Consultar mi programación';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
   
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#prog-dia" aria-controls="prog-dia" role="tab" data-toggle="tab">Programación del día</a></li>
        <li role="presentation"><a href="#prog-mes" aria-controls="prog-mes" role="tab" data-toggle="tab">Programación del mes</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="prog-dia">
            
            <table id="tabla-prog-dia" class="table table-bordered table-striped table-hover table-condensed kv-grid-table">
                <thead>
                    <tr>
                        <th>Código puesto</th>
                        <th>Puesto</th>
                        <th>Cliente</th>
                        <th>Cuadrante</th>
                        <th>Zona</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($programacionDia AS $detalle): ?>
                    <tr <?= $detalle->estado == \app\models\TblDetalleProgSupervisor::ESTADO_VISITADO? 'class="puesto-visitado"' : '' ?> data-fila="<?= $detalle->id_dps ?>" data-id-puesto="<?= $detalle->id_puesto ?>" data-id-programacion="<?= $detalle->id_programacion_supervisor_fk ?>">
                        <td class="codigo_puesto"><?= $detalle->idPuesto->codigo_puesto ?></td>
                        <td class="nombre_puesto"><?= $detalle->idPuesto->nombre_puesto ?></td>
                        <td class="cliente_puesto"><?= $detalle->idPuesto->idClienteFk->nombreCorto ?></td>
                        <td class="cuadrante_puesto"><?= $detalle->idPuesto->idZonaFk->idCuadranteFk->nombre_cuadrante ?></td>
                        <td class="zona_puesto"><?= $detalle->idPuesto->idZonaFk->nombre_zona ?></td>
                        <td class="text-center col-sm-1 accion">
                            <?php if($detalle->estado == \app\models\TblDetalleProgSupervisor::ESTADO_VISITADO): ?>
                            <span class="label label-success">Visitado</span>
                            <?php else: ?>
                            <button data-id-fila="<?= $detalle->id_dps ?>" class="btn-visitar-puesto btn btn-primary btn-condensed btn-xs" title="Visitar puesto" data-toggle="tooltip" data-placement="top">
                                <i class="fa fa-map-marker"></i>
                            </button>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="row">
		<div class="col-sm-12">
		    <nav aria-label="Page navigation">
			<ul class="pagination">
			    <?php $primera = $pagina == 1; ?>
			    <?php if ($primera): ?>
    			    <li class="disabled"><span><i class="fa fa-fast-backward"></i></span></li>
    			    <li class="disabled"><span><i class="fa fa-backward"></i></span></li>
			    <?php else: ?>
    			    <li><a href="<?= yii\helpers\Url::to(['supervisores/consultar-programacion', 'p' => 1]) ?>" aria-label="Previous"><i class="fa fa-fast-backward"></i></a></li>
    			    <li><a href="<?= yii\helpers\Url::to(['supervisores/consultar-programacion', 'p' => $pagina - 1]) ?>" aria-label="Previous"><i class="fa fa-backward"></i></a></li>
			    <?php endif ?>				    
			    <?php for ($i = 1; $i <= $totalPaginas; $i ++): ?>
    			    <li <?= $pagina == $i ? 'class="active"' : '' ?>><a href="<?= yii\helpers\Url::to(['supervisores/consultar-programacion', 'p' => $i]) ?>"><?= $i ?></a></li>
			    <?php endfor ?>
			    <?php $ultima = $pagina == $totalPaginas; ?>
			    <?php if ($ultima): ?>
    			    <li class="disabled"><span><i class="fa fa-forward"></i></span></li>
    			    <li class="disabled"><span><i class="fa fa-fast-forward"></i></span></li>
			    <?php else: ?>
    			    <li class="<?= $ultima ? 'disabled' : '' ?>"><a href="<?= yii\helpers\Url::to(['supervisores/consultar-programacion', 'p' => $pagina + 1]) ?>" aria-label="Next"><i class="fa fa-forward"></i></a></li>
    			    <li><a href="<?= yii\helpers\Url::to(['supervisores/consultar-programacion', 'p' => $totalPaginas]) ?>" aria-label="Next"><i class="fa fa-fast-forward"></i></a></li>
			    <?php endif ?>				
			</ul>
		    </nav>
		</div>
	    </div>
        </div>
        <div role="tabpanel" class="tab-pane fade in" id="prog-mes">
            <?= $this->render('partials/_programacionMes.php', ['diaActual' => $diaActual, 'ultimoDia' => $ultimoDia, 'diasProgramados' => $diasProgramados, 'diasMes' => $diasMes, 'programacionMes' => $programacionMes]) ?>
        </div>
    </div>

</div>

<?php $this->beginBlock('bloque-auxiliar') ?>
<div id="modal-recorrido" class="modal fade modal-wide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="rec-puesto"></span></h4>
            </div>
            <div class="modal-body">
                <?= $this->render('partials/_modalRecorrido') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btn-guardar-recorrido" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endBlock() ?>

<?php $this->beginBlock('js-scripts') ?>
<script>
    var tablaProgDia = $("#tabla-prog-dia tbody");
    var filaSeleccionada = null;
    var latitud = 0;
    var longitud = 0;
    var geo = false;
    var idPuesto;
    var idDetalle;
    var idProgramacion;
    
    $(function(){
        if(navigator.geolocation){
            geo = true;
            navigator.geolocation.getCurrentPosition(obtenerCoordenadas);
        } else {
            console.log("Error al capturar coordenadas.");
        }
        
        $(".btn-visitar-puesto").click(function(){
            filaSeleccionada = $(this).attr("data-id-fila");
            var fila = $("tr[data-fila='" + filaSeleccionada + "']");
            idPuesto = fila.attr("data-id-puesto");
            idProgramacion = fila.attr("data-id-programacion");
            idDetalle = filaSeleccionada;
            
            $("#codigo-puesto").html(fila.find(".codigo_puesto").text());
            $("#nombre-puesto").html(fila.find(".nombre_puesto").text());
            $("#cliente-puesto").html(fila.find(".cliente_puesto").text());
            $("#cuadrante-puesto").html(fila.find(".cuadrante_puesto").text());
            $("#zona-puesto").html(fila.find(".zona_puesto").text());
            $("#modal-recorrido").modal("show");            
        });
        $("#btn-guardar-recorrido").click(function(){
            guardarRecorrido();
        });
    });
    
    var guardarRecorrido = function(){
        $.ajax({
            type: 'POST',
            url : '<?= yii\helpers\Url::to(['supervisores/guardar-recorrido']) ?>',
            data: {
                id_puesto : idPuesto,
                id_programacion: idProgramacion,
                observacion: tinymce.get('recorrido_supervisor').getContent(),
                latitud: latitud,
                longitud: longitud,
                detalle: idDetalle,
            }
        }).done(function(data){
            $("#modal-recorrido").modal("hide");
            if(data.error == false){
                marcarPuestoVisitado(filaSeleccionada);
            }            
        });
    };
    
    var obtenerCoordenadas = function(position){
        if(!geo) return false;
        latitud = position.coords.latitude;
        longitud = position.coords.longitude;        
    };  
    
    var marcarPuestoVisitado = function(id){
        var fila = $("tr[data-fila='" + id + "']");
        var label = $("<span/>", {class: 'label label-success'}).text("Visitado");
        var celdaAccion = fila.find(".accion");
        fila.addClass("puesto-visitado");
        celdaAccion.html(label);
        tablaProgDia.append(fila);
	window.location.reload();
    }
</script>
<?php $this->endBlock() ?>