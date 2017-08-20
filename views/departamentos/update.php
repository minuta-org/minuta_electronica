<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblDepartamentos */

$this->title = 'Actualizar Departamentos';
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_departamento, 'url' => ['view', 'id' => $model->nombre_departamento]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-departamentos-update">

    <div class="page-header">
		<h2><?= Html::encode($this->title) ?></h2>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
