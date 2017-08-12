<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */

$this->title = 'Barrios';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Barrios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-barrios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
    ]) ?>

</div>
