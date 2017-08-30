<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $programacion app\models\TblProgramacionSupervisores */

$this->title = $programacion->nombreSupervisor;
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_supervisor_fk') ?></th>
                <td><?= Html::encode($programacion->nombreSupervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'id_horario_fk') ?></th>
                <td><?= Html::encode($programacion->nombreHorario) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'fecha_inicio_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_inicio_programacion_supervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'fecha_fin_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_fin_programacion_supervisor) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_tipo_programacion_fk') ?></th>
                <td colspan="3"><?= Html::encode($programacion->nombreTipo) ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3>Detalles</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed tabla-programacion">
            <thead>                
                <?= $diasMes ?>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="#"><i class="fa fa-plus-circle"></i></a>
                    </td>
                <?php for($i = 1; $i <= $totalDiasMes; $i ++) : ?>
                    <?php if($i <= $diasAProgramar ): ?>
						<?php if(in_array($i, $diasProgramacion)): ?>
						<td class="celda-a-agregar programado" data-dia="<?= $i ?>">
							<i class="fa fa-check"></i>
						</td>
						<?php else: ?>
						<td class="celda-a-agregar" data-dia="<?= $i ?>"></td>
						<?php endif ?>
                    <?php else: ?>
                    <td class="celda-bloqueada">&nbsp;</td>
                    <?php endif ?>
                <?php endfor ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

    <?php $this->beginBlock('bloque-auxiliar') ?>
    
    <div class="modal fade modal-wide" id="modal-agregar-puesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar puesto</h4>
					<input type="hidden" id="id-programacion" value="<?= $programacion->id_programacion_supervisor ?>">
					<input type="hidden" id="dia-a-guardar" value="">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
    						<div class="form-group wide">
                                <label for="" class="col-sm-2">Cliente</label>
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('select-cliente', '', $clientes, ['class' => 'select-2', 'prompt' => 'Seleccione un cliente', 'id' => 'select-cliente']); ?>
                                </div>
                                <label for="" class="col-sm-2">Cuadrante</label>
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('select-cuadrante', '', $cuadrantes, ['class' => 'select-2', 'prompt' => 'Seleccione un cuadrante', 'id' => 'select-cuadrante']); ?>
                                </div>
                            </div>        
                            <div class="form-group wide">
                                <label for="" class="col-sm-2">Zona</label>
                                <div class="col-sm-4">
                                    <?= Html::dropDownList('select-zona', '', [], ['class' => 'select-2', 'prompt' => 'Seleccione un cliente', 'id' => 'select-zona']); ?>
                                </div>
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button class="btn btn-default btn-xs" id="btn-search-puestos">
                                        Buscar <i class="fa fa-search"></i>
                                    </button>
                                    <button class="btn btn-primary btn-xs" id="btn-add-cliente">
                                        Registrar <i class="fa fa-user-plus"></i>
                                    </button>                                        
                                </div>                                
                            </div>
                        </div>
                        <hr class="col-sm-12">
                    </div>
                    <div class="row">                        
                        <div class="col-sm-12">
                            <table id="tabla-puestos" class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Puesto</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Zona</th>
                                        <th class="text-center">Cuadrante</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="warning">
                                        <td colspan="5" class="text-center">Busca puestos</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-success" id="guardar-puestos" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBlock() ?>


<script>
	var cliente = $("#select-cliente");
	var cuadrante = $("#select-cuadrante");
	var zona = $("#select-zona");
    $(function(){        
        $(".celda-a-agregar").click(function(){
			var tabla = $("#tabla-puestos tbody");
			var tr = $("<tr/>", {class: 'warning'});
			$("#dia-a-guardar").val($(this).attr("data-dia"));			
			resetSelect2(cliente);
			resetSelect2(cuadrante);
			resetSelect2(zona);
			tr.append($("<td/>", {colspan:5, class:'text-center'}).text("Busca puestos"));
			tabla.html(tr);
            $("#modal-agregar-puesto").modal("show");
        });
		
        $("#select-cuadrante").change(function(){
            if($.trim($(this).val()) !== ""){
                consultarClientes($(this).val());
            } else {
                limpiarCombo($("#select-zona"));
            }
        });
		
        $("#btn-search-puestos").click(function(){
            buscarPuestos();
        });
		
		$("#guardar-puestos").click(function(){
			guardarPuestos();
		});
    });
	
	var guardarPuestos = function(){
		var ids = [];
		$(".check-puestos:checked").each(function(k, v){
			ids.push($(v).val());
		});
		if(ids.length === 0) return false;
		var url = '<?= Url::toRoute(['ajax/guardar-puestos']) ?>';
		var programacion = $("#id-programacion").val();
		var diaAProgramar = $("#dia-a-guardar").val();
		var params = {
			'ids' : ids,
			'programacion' : programacion,
			'dia-a-programar' : diaAProgramar,
		};
		doAjax(url, params).done(function(data){
			if(data.error == false){
				var dia = $("[data-dia='" + $("#dia-a-guardar").val() + "']");
				var icono = $("<i/>", {class: 'fa fa-check'});
				dia.addClass("programado").html(icono);
			}
		});
	};
	
	var resetSelect2 = function(select){
		select.val("");
		select.select2("destroy");
		select.select2({width: "100%"});
	};

    var buscarPuestos = function(){
        var url = '<?= Url::toRoute(['ajax/buscar-puestos']) ?>';
        var params = {
            'cliente' : cliente.val(),
            'cuadrante' : cuadrante.val(),
            'zona' : zona.val(),
        };
		var tabla = $("#tabla-puestos tbody");
        doAjax(url, params).done(function(data){
			tabla.html("");
			if(data.puestos && data.puestos.length > 0){
				$.each(data.puestos, function(k, v){
					var tr = $("<tr/>");
					var check = $("<input/>", {type: 'checkbox', 'name' : 'puesto-check[]', class:'check-puestos'}).val(v.id);
					tr.append($("<td/>").text(v.puesto));
					tr.append($("<td/>").text(v.cliente));
					tr.append($("<td/>").text(v.zona));
					tr.append($("<td/>").text(v.cuadrante));
					tr.append($("<td/>", {class:'text-center'}).append(check));
					tabla.append(tr);
				});
			} else {
				var tr = $("<tr/>");
				tr.append($("<td/>",{colspan:5, class:'text-center'}).html("No hay resultados"));
				tabla.append(tr);
			}
        });
    };

    var limpiarCombo = function(combo){
        var primeraOpcion = combo.find("option:first-child");
        combo.html("");
        combo.append(primeraOpcion);
    };

    var consultarClientes = function(idCuadrante){
        var params = {
            'id' : idCuadrante,
            'ajx-rqst' : true,
        };
        doAjax('<?= Url::toRoute(['ajax/get-zonas-cuadrante']) ?>', params).done(function(data){
            var selectPuestos = $("#select-zona");
            var primeraOpcion = selectPuestos.find('option:first-child');
            limpiarCombo(selectPuestos);
            $.each(data.options, function(k, v) {
                selectPuestos.append($("<option/>", {value: v.value}).html(v.name));
            });
            selectPuestos.select2('open');
        });
    }
</script>