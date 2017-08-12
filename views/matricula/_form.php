<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-matricula-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'nit_matricula')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'dv_matricula')->textInput(['maxlength' => true]) ?>                
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'razon_social_matricula')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">                
                    <?= $form->field($model, 'sigla_matricula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'primer_nombre_matricula')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">                
                    <?= $form->field($model, 'segundo_nombre_matricula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'primer_apellido_matricula')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">                
                    <?= $form->field($model, 'segundo_apellido_matricula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'direccion_matricula')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">                
                <?= $form->field($model, 'telefono_matricula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'celular_matricula')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">                
                    <?= $form->field($model, 'email_matricula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">                
                    <?= $form->field($model, 'id_barrio_fk')->dropDownList($barrios, ['prompt' => 'Seleccione un barrio', 'class' => 'select-2']) ?>
                </div>
                <div class="col-sm-6">                
                    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a('Cancelar', ['matricula/index'], ['class' => 'btn btn-warning']) ?>
            </div>            
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
