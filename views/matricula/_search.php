<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblMatriculaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-matricula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_matricula') ?>

    <?= $form->field($model, 'nit_matricula') ?>

    <?= $form->field($model, 'dv_matricula') ?>

    <?= $form->field($model, 'razon_social_matricula') ?>

    <?= $form->field($model, 'sigla_matricula') ?>

    <?php // echo $form->field($model, 'primer_nombre_matricula') ?>

    <?php // echo $form->field($model, 'segundo_nombre_matricula') ?>

    <?php // echo $form->field($model, 'primer_apellido_matricula') ?>

    <?php // echo $form->field($model, 'segundo_apellido_matricula') ?>

    <?php // echo $form->field($model, 'email_matricula') ?>

    <?php // echo $form->field($model, 'telefono_matricula') ?>

    <?php // echo $form->field($model, 'direccion_matricula') ?>

    <?php // echo $form->field($model, 'id_barrio_fk') ?>

    <?php // echo $form->field($model, 'celular_matricula') ?>

    <?php // echo $form->field($model, 'pagina_web') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
