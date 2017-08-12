<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblMunicipios */

$this->title = $model->nombre_municipio;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Municipios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-municipios-view">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id_municipio], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id_municipio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo_municipio',
            'nombre_municipio',
            'nombreDepartamento',
        ],
    ]) ?>

</div>
