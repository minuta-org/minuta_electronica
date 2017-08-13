<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = 'Update Tbl Supervisores: ' . $model->id_supervisor;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_supervisor, 'url' => ['view', 'id' => $model->id_supervisor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-supervisores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
