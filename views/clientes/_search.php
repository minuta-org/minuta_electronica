<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'id_tipo_documento_fk') ?>

    <?= $form->field($model, 'nit_cliente') ?>

    <?= $form->field($model, 'dv_cliente') ?>

    <?= $form->field($model, 'razon_social_cliente') ?>

    <?php // echo $form->field($model, 'sigla_cliente') ?>

    <?php // echo $form->field($model, 'primer_nombre_cliente') ?>

    <?php // echo $form->field($model, 'segundo_nombre_cliente') ?>

    <?php // echo $form->field($model, 'primer_apellido_cliente') ?>

    <?php // echo $form->field($model, 'segundo_apellido_cliente') ?>

    <?php // echo $form->field($model, 'email_cliente') ?>

    <?php // echo $form->field($model, 'telefono_cliente') ?>

    <?php // echo $form->field($model, 'celular_cliente') ?>

    <?php // echo $form->field($model, 'direccion_cliente') ?>

    <?php // echo $form->field($model, 'contacto_cliente') ?>

    <?php // echo $form->field($model, 'telefono_contacto_cliente') ?>

    <?php // echo $form->field($model, 'id_barrio_fk') ?>

    <?php // echo $form->field($model, 'id_sector_comercial_fk') ?>

    <?php // echo $form->field($model, 'id_sector_economico_fk') ?>

    <?php // echo $form->field($model, 'id_dimesion_opt_fk') ?>

    <?php // echo $form->field($model, 'id_origen_judicial_opt_fk') ?>

    <?php // echo $form->field($model, 'id_cobertura_opt_fk') ?>

    <?php // echo $form->field($model, 'id_origen_capital_opt_fk') ?>

    <?php // echo $form->field($model, 'id_matricula_fk') ?>

    <?php // echo $form->field($model, 'observaciones_cliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
