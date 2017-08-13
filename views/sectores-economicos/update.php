<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresEconomicos */

$this->title = 'Update Tbl Sectores Economicos: ' . $model->id_sector_economico;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Sectores Economicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sector_economico, 'url' => ['view', 'id' => $model->id_sector_economico]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-sectores-economicos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
