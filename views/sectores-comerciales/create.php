<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblSectoresComerciales */

$this->title = 'Create Tbl Sectores Comerciales';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Sectores Comerciales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-sectores-comerciales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
