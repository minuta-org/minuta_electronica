<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblDepartamentos */

$this->title = 'Update Tbl Departamentos: ' . $model->id_departamento;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_departamento, 'url' => ['view', 'id' => $model->id_departamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-departamentos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
