<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTiposDocumentos */

$this->title = 'Actualizar Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_documento, 'url' => ['view', 'id' => $model->id_tipo_documento]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-tipos-documentos-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
