<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblTiposProgramacion */

$this->title = $model->id_tipo_programacion;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Programacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tipos-programacion-view">
<div class="tbl-supervisores-view">
   
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?=  Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                                                                            <tr>
                    <th><?= Html::activeLabel($model, 'id_tipo_programacion') ?></th>
                    <td><?= Html::encode($model->id_tipo_programacion) ?></td>
                    <th><?= Html::activeLabel($model, 'nombre_tipo_programacion') ?></th>
                    <td><?= Html::encode($model->nombre_tipo_programacion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'descripcion_tipo_programacion') ?></th>
                    <td><?= Html::encode($model->descripcion_tipo_programacion) ?></td>
                    <th><?= Html::activeLabel($model, 'intervalo_tipo_programacion') ?></th>
                    <td><?= Html::encode($model->intervalo_tipo_programacion) ?></td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <div class="form-group text-right">
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['tipos-programacion/index'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Actualizar '  . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_tipo_programacion], ['class' => 'btn btn-success']) ?>
                <?= 
                Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_tipo_programacion], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar este registro?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>

        </div>
    </div>
</div>
