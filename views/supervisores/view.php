<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblSupervisores */

$this->title = $model->id_supervisor;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-supervisores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_supervisor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_supervisor], [
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
            'id_supervisor',
            'codigo_supervisor',
            'id_tipo_documento_fk',
            'documento_supervisor',
            'primer_nombre_supervisor',
            'segundo_nombre_supervisor',
            'primer_apellido_supervisor',
            'segundo_apellido_supervisor',
            'telefono_supervisor',
            'celular_supervisor',
            'email_supervisor:email',
            'direccion_supervisor',
            'id_barrio_fk',
            'id_matricula_fk',
        ],
    ]) ?>

</div>
