<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Clientes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cliente',
            'id_tipo_documento_fk',
            'nit_cliente',
            'dv_cliente',
            'razon_social_cliente',
            // 'sigla_cliente',
            // 'primer_nombre_cliente',
            // 'segundo_nombre_cliente',
            // 'primer_apellido_cliente',
            // 'segundo_apellido_cliente',
            // 'email_cliente:email',
            // 'telefono_cliente',
            // 'celular_cliente',
            // 'direccion_cliente',
            // 'contacto_cliente',
            // 'telefono_contacto_cliente',
            // 'id_barrio_fk',
            // 'id_sector_comercial_fk',
            // 'id_sector_economico_fk',
            // 'id_dimesion_opt_fk',
            // 'id_origen_judicial_opt_fk',
            // 'id_cobertura_opt_fk',
            // 'id_origen_capital_opt_fk',
            // 'id_matricula_fk',
            // 'observaciones_cliente:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
