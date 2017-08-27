<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblProgramacionSupervisores */

$this->title = $model->nombreSupervisor;
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-programacion-supervisores-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'id_supervisor_fk') ?></th>
                        <td><?= Html::encode($model->nombreSupervisor) ?></td>
                        <th><?= Html::activeLabel($model, 'id_horario_fk') ?></th>
                        <td><?= Html::encode($model->nombreHorario) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'fecha_inicio_programacion_supervisor') ?></th>
                        <td><?= Html::encode($model->fecha_inicio_programacion_supervisor) ?></td>
                        <th><?= Html::activeLabel($model, 'fecha_fin_programacion_supervisor') ?></th>
                        <td><?= Html::encode($model->fecha_fin_programacion_supervisor) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'id_tipo_programacion_fk') ?></th>
                        <td colspan="3"><?= Html::encode($model->nombreTipo) ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['programacion-supervisores/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_programacion_supervisor], ['class' => 'btn btn-success']) ?>
                    <?=
                    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_programacion_supervisor], [
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
