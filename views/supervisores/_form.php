<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-supervisores-form">
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
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <?= $form->field($model, 'codigo_supervisor')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                <?= $form->field($model, 'id_tipo_documento_fk')->dropDownList($tiposDocumento, ['prompt' => 'Seleccione un tipo', 'class' => 'select-2']) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'documento_supervisor')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'primer_nombre_supervisor')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'segundo_nombre_supervisor')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'primer_apellido_supervisor')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'segundo_apellido_supervisor')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'telefono_supervisor')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'celular_supervisor')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email_supervisor')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'direccion_supervisor')->textInput(['maxlength' => true]) ?>
                <label class="control-label col-sm-2">Departamento</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('departamento', $departamentoId, $departamentos, ['prompt' => 'Seleccione un departamento', 'class' => 'select-2 onchange-dependent', 'data-target' => '#combo-municipio', 'data-type' => 'mun']) ?>
                </div>
            </div>
            
            <div class="row">
                <label class="control-label col-sm-2">Municipio</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('municipio', $municipioId, $municipios, ['prompt' => 'Seleccione un municipio', 'class' => 'select-2 onchange-dependent', 'id' => 'combo-municipio', 'data-target' => '#tblsupervisores-id_barrio_fk', 'data-type' => 'bar']) ?>
                </div>
                <?= $form->field($model, 'id_barrio_fk')->dropDownList($barrios, ['Seleccione un barrio', 'class' => 'select-2', 'prompt' => 'Seleccione un barrio']) ?>
            </div>
        </div>            
        <div class = "panel-footer text-right">
                <?php if ($model->isNewRecord): ?>
                    <?= Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
                <?php else: ?>
                    <?= Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
                <?php endif ?>
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['supervisores/index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
<script>
    $(function(){
        $(".onchange-dependent").change(function(){            
            var comboPadre = $(this);
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['supervisores/ajax']) ?>',
                type: 'POST',
                data: {
                    ajx_rqst: true,
                    id: comboPadre.val(),
                    type: comboPadre.attr("data-type")
                }
            }).done(function(data){
                var comboHijo = $(comboPadre.attr("data-target"));
                comboHijo.html(data.html);
                if(comboHijo.hasClass("onchange-dependent")){
                    var hijoDelHijo = $(comboHijo.attr("data-target"));
                    var primeraOpcion = hijoDelHijo.find("option:first-child");
                    hijoDelHijo.html("");
                    hijoDelHijo.append(primeraOpcion);
                }
            });
        });
    });
</script>
