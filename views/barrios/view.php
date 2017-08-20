<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */

$this->title = $model->nombre_barrio;
$this->params['breadcrumbs'][] = ['label' => 'Barrios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-barrios-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'nombre_barrio') ?></th>
                        <td><?= Html::encode($model->nombre_barrio) ?></td>
                        <th><?= Html::activeLabel($model, 'id_municipio_fk') ?></th>
                        <td><?= Html::encode($model->nombreMunicipio) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'codigo_barrio') ?></th>
                        <td><?= Html::encode($model->codigo_barrio) ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['barrios/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_barrio], ['class' => 'btn btn-success']) ?>
                    <?=
                    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_barrio], [
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
