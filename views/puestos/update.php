<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblPuestos */

$this->title = 'Actualizar Puestos';
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_puesto, 'url' => ['view', 'id' => $model->id_puesto]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-puestos-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'zonas' => $zonas,
        'clientes' => $clientes,
        'departamentos' => $departamentos,
        'municipios' => $municipios,
        'barrios' => $barrios,
        'departamentoId' => $departamentoId,
        'municipioId' => $municipioId,
    ]) ?>

</div>
