<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblCuadrantes */

$this->title = 'Nuevo Cuadrantes';
$this->params['breadcrumbs'][] = ['label' => 'Cuadrantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuadrantes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
