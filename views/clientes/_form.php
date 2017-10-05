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
                'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],
            ]); ?>

            <div class="row">
                <?= $form->field($model, 'id_tipo_documento_fk')->dropDownList($tiposDocumentos, ['prompt' => 'Seleccione un tipo de documento']) ?>
                <label id="label-campo-cedula" for="tblclientes-nit_cliente" class="control-label col-sm-2">Cédula</label>
                <div class="col-sm-4 form-group">
                    <div class="input-group">
                        <?= Html::textInput('TblClientes[nit_cliente]', $model->nit_cliente, ['id' => 'tblclientes-nit_cliente', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:100%']) ?>
                        <div class="input-group-addon">-</div>
                        <?= Html::textInput('TblClientes[dv_cliente]', $model->dv_cliente, ['id' => 'tblclientes-dv_cliente', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 1, 'class' => 'form-control', 'style' => 'width:50px', 'readonly' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="row" id="contenedor-nit" style="display:none">
                <?= $form->field($model, 'razon_social_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'sigla_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row contenedor-otros">
                <?= $form->field($model, 'primer_nombre_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'segundo_nombre_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row contenedor-otros">
                <?= $form->field($model, 'primer_apellido_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'segundo_apellido_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <label for="" class="control-label col-sm-2">Municipio</label>
                <div class="col-sm-4 form-group">
                    <?= Html::dropDownList('municipio', $municipioSeleccionado, $municipios, ['class' => 'form-control select-2 onchange-dependent', 'data-target' => '#tblclientes-id_barrio_fk', 'data-type' => 'bar', 'prompt' => 'Seleccione un municipio']) ?>
                </div>
                <?= $form->field($model, 'id_barrio_fk')->dropDownList($barrios, ['class' => 'select-2', 'prompt' => 'Seleccione un barrio']) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'direccion_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'telefono_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'celular_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'contacto_cliente')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'telefono_contacto_cliente')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'id_sector_comercial_fk')->dropDownList($sectoresComerciales, ['class' => 'form-control select-2', 'prompt' => 'Seleccione una opción']) ?>
                <?= $form->field($model, 'id_sector_economico_fk')->dropDownList($sectoresEconomicos, ['class' => 'form-control select-2', 'prompt' => 'Seleccione una opción']) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'id_dimesion_opt_fk')->dropDownList($dimensiones, ['class' => 'form-control', 'prompt' => 'Seleccione una opción']) ?>
                <?= $form->field($model, 'id_origen_judicial_opt_fk')->dropDownList($origenesJudiciales, ['class' => 'form-control', 'prompt' => 'Seleccione una opción']) ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'id_cobertura_opt_fk')->dropDownList($coberturas, ['class' => 'form-control', 'prompt' => 'Seleccione una opción']) ?>
                <?= $form->field($model, 'id_origen_capital_opt_fk')->dropDownList($origenesCapitales, ['class' => 'form-control', 'prompt' => 'Seleccione una opción']) ?>
            </div>
            <div class="row">
                <div class="field-tblclientes-observaciones_cliente has-success">
		<?= $form->field($model, 'observaciones_cliente', [
		    'template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'
		])->textarea(['rows' => 4]) ?>
<!--                    <label class="col-sm-2 control-label" for="tblclientes-observaciones_cliente">Observaciones</label>
		    <div class="col-sm-10 form-group">
			<textarea id="tblclientes-observaciones_cliente" class="form-control" name="TblClientes[observaciones_cliente]" rows="4" aria-invalid="false"></textarea>
			<div class="help-block"></div>
		    </div>-->
                </div>
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

<script>
    $(function(){
	$("#tblclientes-id_tipo_documento_fk").change(function(){
	    var label = $("#label-campo-cedula");
	    var filaEmpresa = $("#contenedor-nit");
	    var filaNombres = $(".contenedor-otros");
	    
	    if($(this).val() == 1){
		label.text("Nit");
		filaNombres.slideUp();
		filaEmpresa.slideDown();
	    } else {
		label.text("Cédula");
		filaEmpresa.slideUp();
		filaNombres.slideDown();
	    }
	});
	$("#tblclientes-nit_cliente").blur(function(){
	    var dv = calcularDv($(this).val());
	    $("#tblclientes-dv_cliente").val(dv);
	});
    });
</script>