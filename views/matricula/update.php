<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = 'Matricula';
$this->params['breadcrumbs'][] = ['label' => 'Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->algunNombre, 'url' => ['view', 'id' => $model->id_matricula]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-matricula-update">


    <?= $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos,
        'barrios' => $barrios,
        'municipios' => $municipios,
        'departamentoId' => $departamentoId,
        'municipioId' => $municipioId,
    ]) ?>

</div>
