<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = 'Matricula: ' . $model->id_matricula;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_matricula, 'url' => ['view', 'id' => $model->id_matricula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-matricula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'barrios' => $barrios,
    ]) ?>

</div>
