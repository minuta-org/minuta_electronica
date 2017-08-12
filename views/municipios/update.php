<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipios */

$this->title = 'Editar Municipio';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Municipios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_municipio, 'url' => ['view', 'id' => $model->id_municipio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-municipios-update">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos,
    ]) ?>

</div>
