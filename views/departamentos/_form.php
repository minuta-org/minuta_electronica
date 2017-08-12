<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblDepartamentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-departamentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_departamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_departamento')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
