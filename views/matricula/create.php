<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = 'Nuevo Matricula';
$this->params['breadcrumbs'][] = ['label' => 'Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matricula-create">

    <?= $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos,
        'barrios' => [],
        'municipios' => [],
        'departamentoId' => null,
        'municipioId' => null,
    ]) ?>

</div>
