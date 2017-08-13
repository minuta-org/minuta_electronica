<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_cliente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_cliente], [
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
            'id_cliente',
            'id_tipo_documento_fk',
            'nit_cliente',
            'dv_cliente',
            'razon_social_cliente',
            'sigla_cliente',
            'primer_nombre_cliente',
            'segundo_nombre_cliente',
            'primer_apellido_cliente',
            'segundo_apellido_cliente',
            'email_cliente:email',
            'telefono_cliente',
            'celular_cliente',
            'direccion_cliente',
            'contacto_cliente',
            'telefono_contacto_cliente',
            'id_barrio_fk',
            'id_sector_comercial_fk',
            'id_sector_economico_fk',
            'id_dimesion_opt_fk',
            'id_origen_judicial_opt_fk',
            'id_cobertura_opt_fk',
            'id_origen_capital_opt_fk',
            'id_matricula_fk',
            'observaciones_cliente:ntext',
        ],
    ]) ?>

</div>
