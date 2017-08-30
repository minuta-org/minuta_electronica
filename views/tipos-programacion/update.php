<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTiposProgramacion */

$this->title = 'Actualizar Tipos Programacion';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Programacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_programacion, 'url' => ['view', 'id' => $model->id_tipo_programacion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-tipos-programacion-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
