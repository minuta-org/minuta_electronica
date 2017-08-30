<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblHorarios */

$this->title = $model->id_horario;
$this->params['breadcrumbs'][] = ['label' => 'Horarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-horarios-view">
<div class="tbl-supervisores-view">
   
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?=  Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                                                                            <tr>
                    <th><?= Html::activeLabel($model, 'id_horario') ?></th>
                    <td><?= Html::encode($model->id_horario) ?></td>
                    <th><?= Html::activeLabel($model, 'nombre_horario') ?></th>
                    <td><?= Html::encode($model->nombre_horario) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'inicio_horario') ?></th>
                    <td><?= Html::encode($model->inicio_horario) ?></td>
                    <th><?= Html::activeLabel($model, 'finaliza_horario') ?></th>
                    <td><?= Html::encode($model->finaliza_horario) ?></td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <div class="form-group text-right">
                <?= Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['horarios/index'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Actualizar '  . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model->id_horario], ['class' => 'btn btn-success']) ?>
                <?= 
                Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id_horario], [
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
