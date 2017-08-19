<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = 'Crear Clientes';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <div class="page-header">
		<h2><?= Html::encode($this->title) ?></h2>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
