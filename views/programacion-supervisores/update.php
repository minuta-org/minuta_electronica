<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblProgramacionSupervisores */

$this->title = 'Actualizar Programacion Supervisores';
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_programacion_supervisor, 'url' => ['view', 'id' => $model->id_programacion_supervisor]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-programacion-supervisores-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'supervisores' => $supervisores,
        'horarios' => $horarios,
        'tipos' => $tipos,        
    ]) ?>

</div>
