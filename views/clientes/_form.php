<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_tipo_documento_fk')->textInput() ?>

    <?= $form->field($model, 'nit_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dv_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sigla_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primer_nombre_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_nombre_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primer_apellido_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundo_apellido_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_contacto_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_barrio_fk')->textInput() ?>

    <?= $form->field($model, 'id_sector_comercial_fk')->textInput() ?>

    <?= $form->field($model, 'id_sector_economico_fk')->textInput() ?>

    <?= $form->field($model, 'id_dimesion_opt_fk')->textInput() ?>

    <?= $form->field($model, 'id_origen_judicial_opt_fk')->textInput() ?>

    <?= $form->field($model, 'id_cobertura_opt_fk')->textInput() ?>

    <?= $form->field($model, 'id_origen_capital_opt_fk')->textInput() ?>

    <?= $form->field($model, 'id_matricula_fk')->textInput() ?>

    <?= $form->field($model, 'observaciones_cliente')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
