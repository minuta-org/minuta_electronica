<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = 'Actualizar Clientes';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cliente, 'url' => ['view', 'id' => $model->id_cliente]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-clientes-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
