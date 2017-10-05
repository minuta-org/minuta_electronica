<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = $model->nombreCorto;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-clientes-view">
    <div class="tbl-supervisores-view">

	<div class="panel panel-success">
	    <div class="panel-heading">
		<h3><?= Html::encode($this->title) ?></h3>
	    </div>
	    <div class="panel-body">
		<table class="table table-bordered table-striped table-hover">
		    <tr>
			<th><?= Html::activeLabel($model, 'id_tipo_documento_fk') ?></th><td><?= Html::encode($model->idTipoDocumentoFk->nombre) ?></td>
			<th><?= Html::activeLabel($model, 'nit_cliente') ?></th><td><?= Html::encode($model->nit_cliente) . '-' . Html::encode($model->dv_cliente) ?></td>
		    </tr>
		    <?php if($model->id_tipo_documento_fk == 1): ?>
		    <tr>
			<th><?= Html::activeLabel($model, 'razon_social_cliente') ?></th><td><?= Html::encode($model->razon_social_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'sigla_cliente') ?></th>
			<td><?= Html::encode($model->sigla_cliente) ?></td>
		    </tr>
		    <?php else: ?>
		    <tr>
			<th><?= Html::activeLabel($model, 'primer_nombre_cliente') ?></th>
			<td><?= Html::encode($model->primer_nombre_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'segundo_nombre_cliente') ?></th>
			<td><?= Html::encode($model->segundo_nombre_cliente) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'primer_apellido_cliente') ?></th>
			<td><?= Html::encode($model->primer_apellido_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'segundo_apellido_cliente') ?></th>
			<td><?= Html::encode($model->segundo_apellido_cliente) ?></td>
		    </tr>
		    <?php endif ?>
		    <tr>
			<th><?= Html::activeLabel($model, 'direccion_cliente') ?></th><td><?= Html::encode($model->direccion_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'id_barrio_fk') ?></th><td><?= Html::encode($model->barrioUbicacionCompleta) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'telefono_cliente') ?></th><td><?= Html::encode($model->telefono_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'celular_cliente') ?></th><td><?= Html::encode($model->celular_cliente) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'email_cliente') ?></th><td><?= Html::encode($model->email_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'contacto_cliente') ?></th><td><?= Html::encode($model->contacto_cliente) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'telefono_contacto_cliente') ?></th><td><?= Html::encode($model->telefono_contacto_cliente) ?></td>
			<th><?= Html::activeLabel($model, 'id_sector_comercial_fk') ?></th><td><?= Html::encode($model->idSectorComercialFk->nombre_sector_comercial) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'id_sector_economico_fk') ?></th><td><?= Html::encode($model->idSectorEconomicoFk->nombre_sector_economico) ?></td>
			<th><?= Html::activeLabel($model, 'id_dimesion_opt_fk') ?></th><td><?= Html::encode($model->dimension) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'id_origen_judicial_opt_fk') ?></th><td><?= Html::encode($model->origenJudicial) ?></td>
			<th><?= Html::activeLabel($model, 'id_cobertura_opt_fk') ?></th><td><?= Html::encode($model->cobertura) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'id_origen_capital_opt_fk') ?></th>
			<td colspan="4"><?= Html::encode($model->origenCapital) ?></td>
		    </tr>
		    <tr>
			<th><?= Html::activeLabel($model, 'observaciones_cliente') ?></th>
			<td colspan="3"><?= Html::encode($model->observaciones_cliente) ?></td>
		    </tr>
		</table>
	    </div>
	    <div class="panel-footer">
		<div class="form-group text-right">
		    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['clientes/index'], ['class' => 'btn btn-warning']) ?>
		    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_cliente], ['class' => 'btn btn-success']) ?>
		    <?=
		    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_cliente], [
			'class' => 'btn btn-danger',
			'data' => [
			    'confirm' => '¿Está seguro que desea eliminar este registro?',
			    'method' => 'post',
			],
		    ])
		    ?>
		</div>

	    </div>
	</div>
    </div>
