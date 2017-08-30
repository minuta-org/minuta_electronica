<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblHorariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-horarios-search">

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
        <?= $form->field($model, 'id_horario') ?>

        <?= $form->field($model, 'nombre_horario') ?>

</div>
<div class="row">
        <?= $form->field($model, 'inicio_horario') ?>

        <?= $form->field($model, 'finaliza_horario') ?>

</div>
        <div class="panel-footer text-right" style="display:none">
        <?=  Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
        <?=  Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
