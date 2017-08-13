<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblSectoresComercialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Sectores Comerciales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-sectores-comerciales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Sectores Comerciales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_sector_comercial',
            'nombre_sector_comercial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
