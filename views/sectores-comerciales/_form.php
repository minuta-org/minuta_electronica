<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-sectores-comerciales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_sector_comercial')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
