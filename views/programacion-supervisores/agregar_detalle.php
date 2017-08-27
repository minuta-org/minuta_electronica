<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $programacion app\models\TblProgramacionSupervisores */

$this->title = $programacion->nombreSupervisor;
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_supervisor_fk') ?></th>
                <td><?= Html::encode($programacion->nombreSupervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'id_horario_fk') ?></th>
                <td><?= Html::encode($programacion->nombreHorario) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'fecha_inicio_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_inicio_programacion_supervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'fecha_fin_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_fin_programacion_supervisor) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_tipo_programacion_fk') ?></th>
                <td colspan="3"><?= Html::encode($programacion->nombreTipo) ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3>Detalles</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed tabla-programacion">
            <thead>                
                <?= $diasMes ?>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                <?php for($i = 1; $i <= $totalDiasMes; $i ++) : ?>
                    <?php if($i <= $diasAProgramar ): ?>
                    <td>&nbsp;</td>
                    <?php else: ?>
                    <td class="celda-bloqueada">&nbsp;</td>
                    <?php endif ?>
                <?php endfor ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>