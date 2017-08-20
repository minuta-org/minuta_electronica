<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipios */

$this->title = 'Nuevo Municipio';
$this->params['breadcrumbs'][] = ['label' => 'Municipios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipios-create">

    <div class="page-header">
		<h2><?= Html::encode($this->title) ?></h2>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos,
    ]) ?>

</div>
