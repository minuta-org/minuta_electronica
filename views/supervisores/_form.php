<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-supervisores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tipo_documento_fk')->textInput() ?>

    <?= $form->field($model, 'documento_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primer_nombre_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_nombre_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primer_apellido_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_apellido_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion_supervisor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_barrio_fk')->textInput() ?>

    <?= $form->field($model, 'id_matricula_fk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
