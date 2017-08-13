<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = 'Create Tbl Clientes';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-clientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
