<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblTiposDocumentos */

$this->title = 'Nuevo Documento';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-documentos-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
