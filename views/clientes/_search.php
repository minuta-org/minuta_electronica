<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => [ 'tag' => false,]
        ],
    ]); ?>
    <div class="panel panel-info panel-filters">
        <div class="panel-heading">
            Filtros <i class="fa fa-filter"></i>
        </div>
        <div class="panel-body" style="display:none">
<div class="row">
        <?= $form->field($model, 'id_cliente') ?>

        <?= $form->field($model, 'id_tipo_documento_fk') ?>

</div>
<div class="row">
        <?= $form->field($model, 'nit_cliente') ?>

        <?= $form->field($model, 'dv_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'razon_social_cliente') ?>

        <?= $form->field($model, 'sigla_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'primer_nombre_cliente') ?>

        <?= $form->field($model, 'segundo_nombre_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'primer_apellido_cliente') ?>

        <?= $form->field($model, 'segundo_apellido_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'email_cliente') ?>

        <?= $form->field($model, 'telefono_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'celular_cliente') ?>

        <?= $form->field($model, 'direccion_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'contacto_cliente') ?>

        <?= $form->field($model, 'telefono_contacto_cliente') ?>

</div>
<div class="row">
        <?= $form->field($model, 'id_barrio_fk') ?>

        <?= $form->field($model, 'id_sector_comercial_fk') ?>

</div>
<div class="row">
        <?= $form->field($model, 'id_sector_economico_fk') ?>

        <?= $form->field($model, 'id_dimesion_opt_fk') ?>

</div>
<div class="row">
        <?= $form->field($model, 'id_origen_judicial_opt_fk') ?>

        <?= $form->field($model, 'id_cobertura_opt_fk') ?>

</div>
<div class="row">
        <?= $form->field($model, 'id_origen_capital_opt_fk') ?>

        <?= $form->field($model, 'id_matricula_fk') ?>

</div>
<div class="row">
        <?= $form->field($model, 'observaciones_cliente') ?>

</div>
        <div class="panel-footer text-right" style="display:none">
        <?=  Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
        <?=  Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
