<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblProgramacionSupervisoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-programacion-supervisores-search">

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
                <?= $form->field($model, 'id_supervisor_fk')->dropDownList($supervisores, ['class' => 'select-2', 'prompt' => 'Busque por supervisor']) ?>
                <?= $form->field($model, 'id_horario_fk')->dropDownList($horarios, ['class' => 'select-2', 'prompt' => 'Busque por horario']) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'fecha_inicio_programacion_supervisor')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>
                <?= $form->field($model, 'fecha_fin_programacion_supervisor')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'id_tipo_programacion_fk')->dropDownList($tipos, ['class' => 'select-2', 'prompt' => 'Busque por tipo']) ?>
            </div>
            <div class="panel-footer text-right" style="display:none">
                <?= Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
