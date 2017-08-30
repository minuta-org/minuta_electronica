<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblZonas */

$this->title = 'Actualizar Zonas';
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_zona, 'url' => ['view', 'id' => $model->id_zona]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-zonas-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
