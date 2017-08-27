<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblRecursos */

$this->title = 'Nuevo Recursos';
$this->params['breadcrumbs'][] = ['label' => 'Recursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recursos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'tiposDocumento' => $tiposDocumento,
        'estados' => $estados,
        'departamentos' => $departamentos,
        'municipios' => [],
        'barrios' => [],
        'departamentoId' => null,
        'municipioId' => null,
    ]) ?>

</div>
