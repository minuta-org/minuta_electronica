<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblPuestos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-puestos-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'role' => 'form'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                            'labelOptions' => ['class' => 'col-sm-2 control-label'],
                            'options' => []
                        ],
            ]);
            ?>

            <div class="row">
                <?= $form->field($model, 'id_cliente_fk')->dropDownList($clientes, ['class' => 'select-2', 'prompt' => 'Seleccione un cliente']) ?>
                <?= $form->field($model, 'nombre_puesto')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'direccion_puesto')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'telefono_puesto')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'contacto_puesto')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'celular_contacto_puesto')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <label class="control-label col-sm-2">Departamento</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('departamento', $departamentoId, $departamentos, ['prompt' => 'Seleccione un departamento', 'class' => 'select-2 onchange-dependent', 'data-target' => '#combo-municipio', 'data-type' => 'mun']) ?>
                </div>
                <label class="control-label col-sm-2">Municipio</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('municipio', $municipioId, $municipios, ['prompt' => 'Seleccione un municipio', 'class' => 'select-2 onchange-dependent', 'id' => 'combo-municipio', 'data-target' => '#tblpuestos-id_barrio_fk', 'data-type' => 'bar']) ?>
                </div>
            </div>

            <div class="row">
                <?= $form->field($model, 'id_barrio_fk')->dropDownList($barrios, ['Seleccione un barrio', 'class' => 'select-2', 'prompt' => 'Seleccione un barrio']) ?>
                <?= $form->field($model, 'id_zona_fk')->dropDownList($zonas, ['class' => 'form-control']) ?>
            </div>

        </div>
        <div class = "panel-footer text-right">
            <?php if ($model->isNewRecord): ?>
                <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
            <?php endif ?>
            <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['puestos/index'], ['class' => 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
