<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblMatricula */

$this->title = $model->razon_social_matricula;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-matricula-view">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id_matricula], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_matricula], [
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
            'nit_matricula',
            'dv_matricula',
            'razon_social_matricula',
            'sigla_matricula',
            'primer_nombre_matricula',
            'segundo_nombre_matricula',
            'primer_apellido_matricula',
            'segundo_apellido_matricula',
            'email_matricula:email',
            'telefono_matricula',
            'direccion_matricula',
            'id_barrio_fk',
            'celular_matricula',
            'pagina_web',
        ],
    ]) ?>

</div>
