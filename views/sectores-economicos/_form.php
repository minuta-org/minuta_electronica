<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresEconomicos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-sectores-economicos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sector_economico')->textInput() ?>

    <?= $form->field($model, 'nombre_sector_economico')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
