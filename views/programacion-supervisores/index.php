<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblProgramacionSupervisoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programacion Supervisores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-programacion-supervisores-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?=  $this->render('_search', ['model' => $searchModel, 'supervisores' => $supervisores, 'horarios' => $horarios, 'tipos' => $tipos]); ?>

<?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-success']);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            'nombreSupervisor',
            'nombreHorario',
            'fecha_inicio_programacion_supervisor',
            'fecha_fin_programacion_supervisor',
            'nombreTipo',
            [
                'attribute' => 'diasProgramados',
                'contentOptions' => ['class' => 'col-sm-1 text-center', 'type' => 'raw'],
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px;'],
                'template' => '{programar}',
                'buttons' => [
                    'programar' => function($url, $model){
                        $i = Html::tag("i", '', ['class' => 'fa fa-list-alt']);
                        return Html::tag("a", $i, ['href' => $url, 'title' => 'Inhabilitar']);
                    },
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-center col-sm-1 fixed-grid-column'],
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
