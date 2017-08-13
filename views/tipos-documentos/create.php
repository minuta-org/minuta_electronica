<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblTiposDocumentos */

$this->title = 'Create Tbl Tipos Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tipos Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tipos-documentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
