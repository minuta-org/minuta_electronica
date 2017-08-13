<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresEconomicos */

$this->title = 'Create Tbl Sectores Economicos';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Sectores Economicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-sectores-economicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
