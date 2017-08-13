<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresComerciales */

$this->title = 'Update Tbl Sectores Comerciales: ' . $model->id_sector_comercial;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Sectores Comerciales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sector_comercial, 'url' => ['view', 'id' => $model->id_sector_comercial]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-sectores-comerciales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
