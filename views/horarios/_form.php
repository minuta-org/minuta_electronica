<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblHorarios */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-horarios-form">
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
    <?= $form->field($model, 'nombre_horario')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'inicio_horario')->textInput() ?>
</div>

    <?= $form->field($model, 'finaliza_horario')->textInput() ?>
        </div>
        <div class = "panel-footer text-right">
                <?php if ($model->isNewRecord): ?>
                    <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
                <?php else: ?>
                    <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
                <?php endif ?>
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['horarios/index'], ['class' => 'btn btn-warning']) ?>
        </div>
<?php ActiveForm::end(); ?>
    </div>
</div>
