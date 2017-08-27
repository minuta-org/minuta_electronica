<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblRecursos */

$this->title = 'Actualizar Recursos';
$this->params['breadcrumbs'][] = ['label' => 'Recursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreCorto, 'url' => ['view', 'id' => $model->id_recurso]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-recursos-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
        'estados' => $estados,
        'departamentos' => $departamentos,
        'municipios' => $municipios,
        'barrios' => $barrios,
        'departamentoId' => $departamentoId,
        'municipioId' => $municipioId,
    ]) ?>

</div>
