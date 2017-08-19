<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblDepartamentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Departamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-departamentos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Departamentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_departamento',
            'codigo_departamento',
            'nombre_departamento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
