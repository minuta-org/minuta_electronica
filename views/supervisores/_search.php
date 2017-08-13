<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblSupervisoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-supervisores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_supervisor') ?>

    <?= $form->field($model, 'codigo_supervisor') ?>

    <?= $form->field($model, 'id_tipo_documento_fk') ?>

    <?= $form->field($model, 'documento_supervisor') ?>

    <?= $form->field($model, 'primer_nombre_supervisor') ?>

    <?php // echo $form->field($model, 'segundo_nombre_supervisor') ?>

    <?php // echo $form->field($model, 'primer_apellido_supervisor') ?>

    <?php // echo $form->field($model, 'segundo_apellido_supervisor') ?>

    <?php // echo $form->field($model, 'telefono_supervisor') ?>

    <?php // echo $form->field($model, 'celular_supervisor') ?>

    <?php // echo $form->field($model, 'email_supervisor') ?>

    <?php // echo $form->field($model, 'direccion_supervisor') ?>

    <?php // echo $form->field($model, 'id_barrio_fk') ?>

    <?php // echo $form->field($model, 'id_matricula_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
