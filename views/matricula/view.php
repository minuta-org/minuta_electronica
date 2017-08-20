<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = $model->algunNombre;
$this->params['breadcrumbs'][] = ['label' => 'Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-matricula-view">
    <div class="tbl-supervisores-view">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th><?= Html::activeLabel($model, 'identificacionCompleta') ?></th>
                        <td><?= Html::encode($model->identificacionCompleta) ?></td>
                        <th><?= Html::activeLabel($model, 'razon_social_matricula') ?></th>
                        <td><?= Html::encode($model->razon_social_matricula) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'sigla_matricula') ?></th>
                        <td><?= Html::encode($model->sigla_matricula) ?></td>
                        <th><?= Html::activeLabel($model, 'nombreCompleto') ?></th>
                        <td><?= Html::encode($model->nombreCompleto) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'direccion_matricula') ?></th>
                        <td><?= Html::encode($model->direccion_matricula) ?></td>
                        <th><?= Html::activeLabel($model, 'telefono_matricula') ?></th>
                        <td><?= Html::encode($model->telefono_matricula) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'celular_matricula') ?></th>
                        <td><?= Html::encode($model->celular_matricula) ?></td>
                        <th><?= Html::activeLabel($model, 'email_matricula') ?></th>
                        <td><?= Html::encode($model->email_matricula) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::encode("Departamento") ?></th>
                        <td><?= Html::encode($model->idBarrioFk->idMunicipioFk->idDepartamentoFk->nombre_departamento) ?></td>
                        <th><?= Html::encode("Municipio") ?></th>
                        <td><?= Html::encode($model->idBarrioFk->idMunicipioFk->nombre_municipio) ?></td>
                    </tr>
                    <tr> 
                        <th><?= Html::activeLabel($model, 'id_barrio_fk') ?></th>
                        <td><?= Html::encode($model->idBarrioFk->nombre_barrio) ?></td>
                        <th><?= Html::activeLabel($model, 'pagina_web') ?></th>
                        <td><?= Html::encode($model->pagina_web) ?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <div class="form-group text-right">
                    <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['matricula/index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Actualizar ' . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_matricula], ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
    </div>
