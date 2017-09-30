<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-clientes-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
<?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
            ],
            ]); ?>

                        <div class="row">
    <?= $form->field($model, 'id_tipo_documento_fk')->textInput() ?>
    <?= $form->field($model, 'nit_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'dv_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'razon_social_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'sigla_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'primer_nombre_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'segundo_nombre_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'primer_apellido_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'segundo_apellido_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'telefono_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'celular_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'direccion_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contacto_cliente')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'telefono_contacto_cliente')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'id_barrio_fk')->textInput() ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_sector_comercial_fk')->textInput() ?>
    <?= $form->field($model, 'id_sector_economico_fk')->textInput() ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_dimesion_opt_fk')->textInput() ?>
    <?= $form->field($model, 'id_origen_judicial_opt_fk')->textInput() ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_cobertura_opt_fk')->textInput() ?>
    <?= $form->field($model, 'id_origen_capital_opt_fk')->textInput() ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_matricula_fk')->textInput() ?>
    <?= $form->field($model, 'observaciones_cliente')->textarea(['rows' => 6]) ?>
</div>

        </div>
        <div class = "panel-footer text-right">
                <?php if ($model->isNewRecord): ?>
                    <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
                <?php else: ?>
                    <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
                <?php endif ?>
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['clientes/index'], ['class' => 'btn btn-warning']) ?>
        </div>
<?php ActiveForm::end(); ?>
    </div>
</div>
