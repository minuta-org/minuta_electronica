<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-barrios-form">
    <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
    <div class="panel panel-default">
        <div class="panel-body">

            <?= $form->field($model, 'codigo_barrio')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'autofocus' => true]) ?>

            <?= $form->field($model, 'nombre_barrio')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_municipio_fk')->dropDownList($municipios, ['prompt' => 'Seleccione un municipio', 'class' => 'select-2']) ?>

        </div>
        <div class="panel-footer">            
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Cancelar', ['barrios/index'], ['class' => 'btn btn-warning']) ?>
            </div>   
        </div>
    </div>
    <?php ActiveForm::end(); ?>            
</div>
