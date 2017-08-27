<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TblProgramacionSupervisores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-programacion-supervisores-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'role' => 'form'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-2 control-label'],
                            'options' => []
                        ],
            ]);
            ?>

            <div class="row">
                <?= $form->field($model, 'id_supervisor_fk')->dropDownList($supervisores, ['class' => 'select-2', 'prompt' => 'Seleccione un supervisor']) ?>
                <?= $form->field($model, 'id_horario_fk')->dropDownList($horarios, ['class' => 'select-2', 'prompt' => 'Seleccionar horario']) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'fecha_inicio_programacion_supervisor')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>
                <?= $form->field($model, 'fecha_fin_programacion_supervisor')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'id_tipo_programacion_fk')->dropDownList($tipos, ['class' => 'select-2']) ?>
            </div>
        </div>
        <div class = "panel-footer text-right">
            <?php if ($model->isNewRecord): ?>
                <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
            <?php endif ?>
            <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['programacion-supervisores/index'], ['class' => 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
