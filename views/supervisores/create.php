<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = 'Create Tbl Supervisores';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-supervisores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
