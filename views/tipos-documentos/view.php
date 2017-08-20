<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblTiposDocumentos */

$this->title = $model->concepto;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tipos-documentos-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'nombre') ?></th>
                        <td><?= Html::encode($model->nombre) ?></td>
                        <th><?= Html::activeLabel($model, 'concepto') ?></th>
                        <td><?= Html::encode($model->concepto) ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['tipos-documentos/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_tipo_documento], ['class' => 'btn btn-success']) ?>
                    <?=
                    Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_tipo_documento], [
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
