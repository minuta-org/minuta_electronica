<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-municipios-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-body">

            <?= $form->field($model, 'codigo_municipio')->textInput(['maxlength' => true, 'autofocus' => true, 'readonly' => !$model->isNewRecord]) ?>

            <?= $form->field($model, 'nombre_municipio')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_departamento_fk')->dropDownList($departamentos, ['prompt' => 'Seleccione un departamento', 'class' => 'select-2']) ?>

        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Cancelar', ['municipios/index'], ['class' => 'btn btn-warning']) ?>
            </div>            
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>