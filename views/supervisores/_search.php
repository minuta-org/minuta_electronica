<?php

/**
 * 
 * Verde: guardar
 * Rojo: eliminar
 * Amarillo: cancelar.
 * Azul: buscar.
 * 
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TblSupervisoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-supervisores-search">
    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => [ 'tag' => false,]
        ],
    ]);
    ?>
    <div class="panel panel-info panel-filters">
        <div class="panel-heading">
            Filtros <i class="fa fa-filter"></i>
        </div>
        <div class="panel-body" style="display:none">


            <div class="row">
                <?= $form->field($model, 'nombreCompleto') ?>
                <?= $form->field($model, 'documento_supervisor')?>
            </div>
            <div class="row">
                <?= $form->field($model, 'codigo_supervisor') ?>
            </div>
            

            <?php // echo $form->field($model, 'segundo_nombre_supervisor') ?>

            <?php // echo $form->field($model, 'primer_apellido_supervisor') ?>

            <?php // echo $form->field($model, 'segundo_apellido_supervisor') ?>

            <?php // echo $form->field($model, 'telefono_supervisor') ?>

            <?php // echo $form->field($model, 'celular_supervisor') ?>

            <?php // echo $form->field($model, 'email_supervisor') ?>

            <?php // echo $form->field($model, 'direccion_supervisor') ?>

            <?php // echo $form->field($model, 'id_barrio_fk') ?>

            <?php // echo $form->field($model, 'id_matricula_fk')  ?>


        </div>
        <div class="panel-footer text-right" style="display:none">
            <?= Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>

<script>
    $(function () {
        var panel = $(".panel-filters");
        panel.find(".panel-heading").click(function () {
            panel.find(".panel-body").slideToggle(function(){
                panel.find(".panel-footer").fadeToggle();
                //panel.find("input").first().focus();
            });
        });
    });
</script>