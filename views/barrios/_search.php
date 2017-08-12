<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblBarriosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-barrios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_barrio') ?>

    <?= $form->field($model, 'nombre_barrio') ?>

    <?= $form->field($model, 'id_municipio_fk') ?>

    <?= $form->field($model, 'codigo_barrio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
