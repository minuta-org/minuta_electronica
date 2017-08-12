<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipiosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-municipios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_municipio') ?>

    <?= $form->field($model, 'codigo_municipio') ?>

    <?= $form->field($model, 'nombre_municipio') ?>

    <?= $form->field($model, 'id_departamento_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
