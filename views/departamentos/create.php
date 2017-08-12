<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblDepartamentos */

$this->title = 'Create Tbl Departamentos';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-departamentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
