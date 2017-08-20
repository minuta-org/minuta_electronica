<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblBarriosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-barrios-search">

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

                <?= $form->field($model, 'nombre_barrio') ?>
                <?= $form->field($model, 'id_municipio_fk')->dropDownList($municipios, ['prompt' => 'Busque por municipio', 'class' => 'select-2']) ?>

            </div>
            <div class="row">


                <?= $form->field($model, 'codigo_barrio') ?>
            </div>
            <div class="panel-footer text-right" style="display:none">
                <?= Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
