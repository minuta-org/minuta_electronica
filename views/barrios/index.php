<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblBarriosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barrios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-barrios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="text-right">
        <?= Html::a('Crear Barrio', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo_barrio',
            'nombre_barrio',
            'nombreMunicipio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'summary' => '<h4><span class="label label-default">Total: {totalCount}</span></h4>',
    ]); ?>
</div>
