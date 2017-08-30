<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblCuadrantes */

$this->title = 'Actualizar Cuadrantes';
$this->params['breadcrumbs'][] = ['label' => 'Cuadrantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cuadrante, 'url' => ['view', 'id' => $model->id_cuadrante]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-cuadrantes-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
