<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TblSupervisoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supervisores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-supervisores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
    $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-success']);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        #'filterModel' => $searchModel,
        'columns' => [
            'codigo_supervisor',
            'tipoDocumento',
            'documento_supervisor',
            'nombreCompleto',
            'direccion_supervisor',
            'telefono_supervisor',
            'celular_supervisor',
            // 'email_supervisor:email',
            // 'id_barrio_fk',
            // 'id_matricula_fk',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'summary' => '<span class="summary label label-default">Registros: {totalCount}</span>',
        'layout' => '{summary}{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton . '</div></div>',
        
    ]); ?>
</div>
