<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblProgramacionSupervisores */

$this->title = 'Nuevo Programacion Supervisores';
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programacion-supervisores-create">

    <?= $this->render('_form', [
        'model' => $model,
        'supervisores' => $supervisores,
        'horarios' => $horarios,
        'tipos' => $tipos,
    ]) ?>

</div>
