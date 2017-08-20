<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */

$this->title = 'Nuevo Barrio';
$this->params['breadcrumbs'][] = ['label' => 'Barrios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barrios-create">

    <div class="page-header">
		<h2><?= Html::encode($this->title) ?></h2>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
    ]) ?>

</div>
