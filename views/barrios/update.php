<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBarrios */

$this->title = 'Actualizar {modelClass}';
$this->params['breadcrumbs'][] = ['label' => 'Barrios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_barrio, 'url' => ['view', 'id' => $model->id_barrio]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-barrios-update">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?=
    $this->render('_form', [
        'model' => $model,
        'municipios' => $municipios,
    ])
    ?>

</div>
