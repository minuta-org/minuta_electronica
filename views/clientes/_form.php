<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-clientes-form">
	<div class="panel panel-default">		
		<div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
		
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'id_tipo_documento_fk')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'nit_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'dv_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'razon_social_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'sigla_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'primer_nombre_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'segundo_nombre_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'primer_apellido_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'segundo_apellido_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'email_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'telefono_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'celular_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'direccion_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'contacto_cliente')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'telefono_contacto_cliente')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'id_barrio_fk')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'id_sector_comercial_fk')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'id_sector_economico_fk')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'id_dimesion_opt_fk')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'id_origen_judicial_opt_fk')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'id_cobertura_opt_fk')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'id_origen_capital_opt_fk')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'id_matricula_fk')->textInput() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'observaciones_cliente')->textarea(['rows' => 6]) ?>
    </div>
</div>

		</div>
		<div class="panel-footer">
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				<?= Html::a('Cancelar', ['clientes/index'], ['class' => 'btn btn-warning']) ?>
			</div>
		</div>
    <?php ActiveForm::end(); ?>
	</div>
</div>
