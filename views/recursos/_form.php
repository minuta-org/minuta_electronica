<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblRecursos */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-recursos-form">
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
    <?= $form->field($model, 'documento_recurso')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'primer_nombre_recurso')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'segundo_nombre_recurso')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'primer_apellido_recurso')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'segundo_apellido_recurso')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'email_recurso')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'direccion_recurso')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'telefono_recurso')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'celular_recurso')->textInput(['maxlength' => true]) ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_barrio_fk')->textInput() ?>
    <?= $form->field($model, 'estado_recurso')->textInput() ?>
</div>

        </div>
        <div class = "panel-footer text-right">
                <?php if ($model->isNewRecord): ?>
                    <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
                <?php else: ?>
                    <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
                <?php endif ?>
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['recursos/index'], ['class' => 'btn btn-warning']) ?>
        </div>
<?php ActiveForm::end(); ?>
    </div>
</div>
