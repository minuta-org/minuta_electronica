<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblMunicipiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Municipios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-municipios-index">

    <div class="page-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="text-right">
        <?= Html::a('Crear Municipio', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'codigo_municipio',
//            'nombre_municipio',
//            'nombreDepartamento', 
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); 
    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'codigo_municipio',
            'nombre_municipio',
            'nombreDepartamento', 
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'summary' => '<h4><span class="label label-default">Total: {totalCount}</span></h4>',
        'responsive'=>true,
        'hover'=>true
    ]);
    ?>
</div>
