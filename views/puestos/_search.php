<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblPuestosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-puestos-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => ['tag' => false,]
                ],
    ]);
    ?>
    <div class="panel panel-info panel-filters">
        <div class="panel-heading">
            Filtros <i class="fa fa-filter"></i>
        </div>
        <div class="panel-body" style="display:none">
            <div class="row">
                <?= $form->field($model, 'id_cliente_fk')->dropDownList($clientes, ['class' => 'select-2', 'prompt' => 'Busque por cliente']) ?>
                <?= $form->field($model, 'nombre_puesto') ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'contacto_puesto') ?>
                <?= $form->field($model, 'id_zona_fk')->dropDownList($zonas, ['class' => 'form-control', 'prompt' => 'Busque por zona']) ?>
            </div>
            <div class="row">
                <label class="control-label col-sm-2">Municipio</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('municipio', '', $municipios, ['prompt' => 'Seleccione un municipio', 'class' => 'select-2 onchange-dependent', 'id' => 'combo-municipio', 'data-target' => '#tblpuestossearch-id_barrio_fk', 'data-type' => 'bar']) ?>
                </div>
                <?= $form->field($model, 'id_barrio_fk')->dropDownList([], ['class' => 'select-2', 'prompt' => 'Busque por barrio']) ?>
            </div>
            <div class="panel-footer text-right" style="display:none">
                <?= Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
