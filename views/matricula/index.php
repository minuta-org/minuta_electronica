<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblMatriculaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matriculas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-matricula-index">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="text-right">
        <?= Html::a('Crear Matricula', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'nit_matricula',
            'razon_social_matricula',
            'sigla_matricula',
            'nombreCorto',
            'telefono_matricula',
            'barrio',
            //'pagina_web',
//            'dv_matricula',
            // 'email_matricula:email',
            // 'direccion_matricula',
            // 'celular_matricula',
            ['class' => 'yii\grid\ActionColumn', 'options' => ['class' => 'col-sm-1']],
        ],
        'summary' => '<h4><span class="label label-default">Total: {totalCount}</span></h4>',
        'responsive'=>true,
        'hover'=>true
    ]); ?>
</div>
