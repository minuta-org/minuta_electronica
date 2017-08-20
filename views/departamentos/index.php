<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\TblDepartamentos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblDepartamentos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-departamentos-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?=  $this->render('_search', ['model' => $searchModel]); ?>

<?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-success']);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'codigo_departamento',
                'contentOptions' => ['class' => 'col-sm-3'],
            ],
            'nombre_departamento',
            [
                'attribute' => 'etiquetaEstado',
                'contentOptions' => ['class' => 'col-sm-1', 'type' => 'raw'],
                'format' => 'raw',
            ],
            [ 
                'class' => 'yii\grid\ActionColumn',
                'template' => '{state}',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px;'],
                'buttons' => [
                    'state' => function($url, $model){ 
                        $i = Html::tag("i", '', ['class' => 'fa hard fa-' . ($model->estado == TblDepartamentos::ESTADO_ACTIVO? 'ban' : 'check')]);
                        return Html::tag("a", $i, ['href' => $url, 'title' => 'Inhabilitar']);
                    },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'col-sm-1 text-center'],
            ],
        ],
        'tableOptions' => ['class' => 'table-condensed'],
        'summary' => '<span class="summary label label-default">Registros: {totalCount}</span>',
        'layout' => '{summary}{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton . '</div></div>',
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
    ]); ?>
</div>
