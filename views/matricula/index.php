<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblMatriculaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matricula';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-matricula-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            'identificacionCompleta',
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
            // 'pagina_web',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['class' => 'text-center col-sm-1 fixed-grid-column'],
            ],
        ],
        'tableOptions' => ['class' => 'table-condensed'],
        'summary' => '<span class="summary label label-default">Registros: {totalCount}</span>',
        'layout' => '{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right"></div></div>',
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
    ]); ?>
</div>
