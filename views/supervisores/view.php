<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = $model->nombreCompleto;
$this->params['breadcrumbs'][] = ['label' => 'Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-supervisores-view">
   
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'codigo_supervisor') ?></th>
                    <td><?= Html::encode($model->codigo_supervisor) ?></td>
                    <th><?= Html::activeLabel($model, 'id_tipo_documento_fk') ?></th>
                    <td><?= Html::encode($model->tipoDocumento) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'documento_supervisor') ?></th>
                    <td><?= Html::encode($model->documento_supervisor) ?></td>
                    <th><?= Html::activeLabel($model, 'direccion_supervisor') ?></th>
                    <td><?= Html::encode($model->direccion_supervisor) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'telefono_supervisor') ?></th>
                    <td><?= Html::encode($model->telefono_supervisor) ?></td>
                    <th><?= Html::activeLabel($model, 'celular_supervisor') ?></th>
                    <td><?= Html::encode($model->celular_supervisor) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'email_supervisor') ?></th>
                    <td><?= Html::encode($model->email_supervisor) ?></td>
                    <th><?= Html::activeLabel($model, 'id_barrio_fk') ?></th>
                    <td><?= Html::encode($model->idBarrioFk->barrioMunicipio) ?></td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <div class="form-group text-right">
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['supervisores/index'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Actualizar '  . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_supervisor], ['class' => 'btn btn-success']) ?>
                <?=
                Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_supervisor], [
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
