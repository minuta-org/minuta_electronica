<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblPuestos */

$this->title = $model->nombre_puesto;
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-puestos-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'id_cliente_fk') ?></th>
                        <td><?= Html::encode($model->nombreCliente) ?></td>
                        <th><?= Html::activeLabel($model, 'nombre_puesto') ?></th>
                        <td><?= Html::encode($model->nombre_puesto) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'direccion_puesto') ?></th>
                        <td><?= Html::encode($model->direccion_puesto) ?></td>
                        <th><?= Html::activeLabel($model, 'telefono_puesto') ?></th>
                        <td><?= Html::encode($model->telefono_puesto) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'contacto_puesto') ?></th>
                        <td><?= Html::encode($model->contacto_puesto) ?></td>
                        <th><?= Html::activeLabel($model, 'celular_contacto_puesto') ?></th>
                        <td><?= Html::encode($model->celular_contacto_puesto) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'id_zona_fk') ?></th>
                        <td><?= Html::encode($model->nombreZona) ?></td>
                        <th><?= Html::activeLabel($model, 'id_barrio_fk') ?></th>
                        <td><?= Html::encode($model->idBarrioFk->ubicacionCompleta) ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['puestos/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_puesto], ['class' => 'btn btn-success']) ?>
                    <?=
                    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_puesto], [
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
