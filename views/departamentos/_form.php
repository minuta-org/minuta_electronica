<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblDepartamentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-departamentos-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'role' => 'form'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-8 form-group">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-4 control-label'],
                            'options' => []
                        ],
            ]);
            ?>

            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <?= $form->field($model, 'codigo_departamento')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    <?= $form->field($model, 'nombre_departamento')->textInput(['maxlength' => true]) ?>                    
                </div>
            </div>

        </div>
        <div class = "panel-footer text-right">
            <?php if ($model->isNewRecord): ?>
                <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
            <?php endif ?>
            <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['departamentos/index'], ['class' => 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
