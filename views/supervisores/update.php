<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = 'Supervisores';
$this->params['breadcrumbs'][] = ['label' => 'Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreCompleto, 'url' => ['view', 'id' => $model->id_supervisor]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-supervisores-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
        'departamentos' => $departamentos,
        'municipios' => $municipios,
        'barrios' => $barrios,
        'departamentoId' => $departamentoId,
        'municipioId' => $municipioId,
    ]) ?>

</div>
