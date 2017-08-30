<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblHorarios */

$this->title = 'Nuevo Horarios';
$this->params['breadcrumbs'][] = ['label' => 'Horarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horarios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
