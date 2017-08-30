<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblZonas */

$this->title = 'Nuevo Zonas';
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zonas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
