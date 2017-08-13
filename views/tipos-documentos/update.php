<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTiposDocumentos */

$this->title = 'Update Tbl Tipos Documentos: ' . $model->id_tipo_documento;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tipos Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_documento, 'url' => ['view', 'id' => $model->id_tipo_documento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-tipos-documentos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
