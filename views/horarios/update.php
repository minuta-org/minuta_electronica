<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblHorarios */

$this->title = 'Actualizar Horarios';
$this->params['breadcrumbs'][] = ['label' => 'Horarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_horario, 'url' => ['view', 'id' => $model->id_horario]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-horarios-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
