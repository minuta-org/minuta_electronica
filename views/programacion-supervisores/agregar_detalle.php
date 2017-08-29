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
                    <td class="celda-a-agregar"></td>
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
                </div>
                <div class="modal-body">
                    <div class="row">
						<div class="form-group">
                            <input type="hidden" id="dia-programacion" name="programacion[dia]">
                            <label for="" class="col-sm-1">Cliente</label>
                            <div class="col-sm-4">
                                <?= Html::dropDownList('cliente', '', $clientes, ['class' => 'select-2', 'prompt' => 'Seleccione un cliente', 'id' => 'selec-cliente']); ?>
                            </div>
                            <label for="" class="col-sm-1">Puesto</label>
                            <div class="col-sm-3">
                                <?= Html::dropDownList('puestos', '', [], ['class' => 'select-2', 'prompt' => 'Seleccione un puesto', 'id' => 'selec-puesto']); ?>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-success btn-xs" id="btn-add-cliente">
                                    Añadir <i class="fa fa-plus"></i>
                                </button>
                                <button class="btn btn-primary btn-xs" id="btn-add-cliente">
                                    Registrar <i class="fa fa-user-plus"></i>
                                </button>
                            </div>
                        </div>
                        <hr class="col-sm-12">
                    </div>
                    <div class="row">                        
                        <div class="col-sm-6">
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Puesto</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="warning">
                                        <td colspan="3" class="text-center">Sin puestos</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Información del puesto</div>
                                <div class="panel-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBlock() ?>


<script>
    $(function(){        
        $(".celda-a-agregar").click(function(){
            $("#modal-agregar-puesto").modal("show");
        });
        $("#selec-cliente").change(function(){
            if($.trim($(this).val()) !== ""){
                consultarClientes($(this).val());
            } else {
                limpiarCompo($("#selec-puesto"));
            }
        });
    });

    var limpiarCompo = function(combo){
        var primeraOpcion = combo.find("option:first-child");
        combo.html("");
        combo.append(primeraOpcion);
    };

    var consultarClientes = function(idCliente){
        $.ajax({
            'type' : 'POST',
            'url'  : '<?= Url::toRoute(['ajax/get-puestos-cliente']) ?>',
            'data' : {
                'id' : idCliente,
                'ajx-rqst' : true,
            },
        }).done(function(data){
            var selectPuestos = $("#selec-puesto");
            var primeraOpcion = selectPuestos.find('option:first-child');
            limpiarCompo(selectPuestos);
            $.each(data.options, function(k, v){
                console.log(v);
                selectPuestos.append($("<option/>", {value: v.value}).html(v.name));
            });
            selectPuestos.select2('open');
        });
    }
</script>