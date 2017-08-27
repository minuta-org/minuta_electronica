<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblPuestos */

$this->title = 'Nuevo Puestos';
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puestos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'zonas' => $zonas,
        'clientes' => $clientes,
        'departamentos' => $departamentos,
        'municipios' => [],
        'barrios' => [],
        'departamentoId' => null,
        'municipioId' => null,
    ]) ?>

</div>
