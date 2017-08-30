<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblTiposProgramacion */

$this->title = 'Nuevo Tipos Programacion';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Programacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-programacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
