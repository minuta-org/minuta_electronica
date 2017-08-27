<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblRecursos */

$this->title = $model->nombreCorto;
$this->params['breadcrumbs'][] = ['label' => 'Recursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-recursos-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'id_tipo_documento_fk') ?></th>
                        <td><?= Html::encode($model->idTipoDocumentoFk->nombre) ?></td>
                        <th><?= Html::activeLabel($model, 'documento_recurso') ?></th>
                        <td><?= Html::encode($model->documento_recurso) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'primer_nombre_recurso') ?></th>
                        <td><?= Html::encode($model->nombreCorto) ?></td>
                        <th><?= Html::activeLabel($model, 'direccion_recurso') ?></th>
                        <td><?= Html::encode($model->direccion_recurso) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'telefono_recurso') ?></th>
                        <td><?= Html::encode($model->telefono_recurso) ?></td>
                        <th><?= Html::activeLabel($model, 'celular_recurso') ?></th>
                        <td><?= Html::encode($model->celular_recurso) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'email_recurso') ?></th>
                        <td><?= Html::encode($model->email_recurso) ?></td>
                        <th><?= Html::activeLabel($model, 'id_barrio_fk') ?></th>
                        <td><?= Html::encode($model->idBarrioFk->ubicacionCompleta) ?></td>
                    </tr>
                    <tr>                    
                        <th><?= Html::activeLabel($model, 'estado_recurso') ?></th>
                        <td colspan="3"><?= $model->etiquetaEstado ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['recursos/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_recurso], ['class' => 'btn btn-success']) ?>
                    <?=
                    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_recurso], [
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
