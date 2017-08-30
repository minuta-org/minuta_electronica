<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblHorariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Horarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-horarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?=  $this->render('_search', ['model' => $searchModel]); ?>

<?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-success']);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [

            'id_horario',
            'nombre_horario',
            'inicio_horario',
            'finaliza_horario',
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
