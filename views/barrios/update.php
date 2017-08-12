<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */

$this->title = 'Barrios';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Barrios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_barrio, 'url' => ['view', 'id' => $model->id_barrio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-barrios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
    ]) ?>

</div>
