<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblSupervisoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Supervisores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-supervisores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Supervisores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_supervisor',
            'codigo_supervisor',
            'id_tipo_documento_fk',
            'documento_supervisor',
            'primer_nombre_supervisor',
            // 'segundo_nombre_supervisor',
            // 'primer_apellido_supervisor',
            // 'segundo_apellido_supervisor',
            // 'telefono_supervisor',
            // 'celular_supervisor',
            // 'email_supervisor:email',
            // 'direccion_supervisor',
            // 'id_barrio_fk',
            // 'id_matricula_fk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
