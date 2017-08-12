<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipios */

$this->title = 'Crear Municipio';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Municipios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-municipios-create">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos
    ]) ?>

</div>
