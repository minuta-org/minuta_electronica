<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = 'Nuevo Supervisor';
$this->params['breadcrumbs'][] = ['label' => 'Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tbl-supervisores-create">

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
        'departamentos' => $departamentos,
        'municipios' => [],
        'barrios' => [],
        'departamentoId' => null,
        'municipioId' => null,
    ]) ?>

</div>
