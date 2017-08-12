<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = 'Matricula';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-matricula-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'barrios' => $barrios,
    ]) ?>

</div>
