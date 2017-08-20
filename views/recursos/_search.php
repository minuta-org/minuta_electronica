<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblRecursosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-recursos-search">

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
                <?= $form->field($model, 'nombreCorto') ?>
                <?= $form->field($model, 'documento_recurso') ?>

            </div>
            <div class="row">
                <?= $form->field($model, 'codigo_recurso') ?>
                <label class="control-label col-sm-2">Municipio</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('municipio', '', $municipios, ['prompt' => 'Seleccione un municipio', 'class' => 'select-2 onchange-dependent', 'id' => 'combo-municipio', 'data-target' => '#tblrecursossearch-id_barrio_fk', 'data-type' => 'bar']) ?>
                </div>
            </div>
            
            <div class="row">
                <?= $form->field($model, 'id_barrio_fk')->dropDownList([], ['prompt' => 'Busque por barrio', 'class' => 'select-2']) ?>
                <?= $form->field($model, 'estado_recurso') ?>
            </div>
            <div class="panel-footer text-right" style="display:none">
                <?= Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
