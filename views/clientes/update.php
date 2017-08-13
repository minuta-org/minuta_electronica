<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = 'Update Tbl Clientes: ' . $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cliente, 'url' => ['view', 'id' => $model->id_cliente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-clientes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
