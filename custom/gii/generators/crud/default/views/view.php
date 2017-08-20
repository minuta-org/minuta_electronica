<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename(str_replace('Tbl', '', $generator->modelClass))))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
<div class="tbl-supervisores-view">
   
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= "<?= "?> Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
<?php if (($tableSchema = $generator->getTableSchema()) === false) : ?>                    
    <?php foreach ($generator->getColumnNames() as $name) : ?>
        <?php 
//        echo "            '" . $name . "',\n";
        ?>
    <?php endforeach ?>    
<?php else : ?>
    <?php 
    $primaryKey = ""; 
    $rows = [];
    $cols = "";
    $cont = 0;
    ?>
    <?php foreach ($generator->getTableSchema()->columns as $column) : ?>
        <?php 
        $cont ++;
        $cols .= "                    <th><?= Html::activeLabel(\$model, '{$column->name}') ?></th>\n";
        $cols .= "                    <td><?= Html::encode(\$model->{$column->name}) ?></td>\n";
        if($column->isPrimaryKey){
            $primaryKey = $column->name;
        }
        if($cont % 2 == 0){
            $rows[] = "                <tr>\n{$cols}                </tr>\n";
            $cols = "";
        }        
        ?>
    <?php endforeach ?>
    <?php 
    if($cols !== ""){
        $rows[] = "                <tr>{$cols}</tr>\n";
    }
    echo implode("", $rows);
    ?>
<?php endif; ?>
            </table>
        </div>
        <div class="panel-footer">
            <div class="form-group text-right">
                <?= "<?=" ?> Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['<?= $generator->controllerID ?>/index'], ['class' => 'btn btn-warning']) ?>
                <?= "<?=" ?> Html::a('Actualizar '  . Html::tag('i', '', ['class' => 'fa fa-pencil']), ['update', 'id' => $model-><?= $primaryKey?>], ['class' => 'btn btn-success']) ?>
                <?= "<?=" ?> 
                Html::a('Eliminar ' . Html::tag('i', '', ['class' => 'fa fa-trash']), ['delete', 'id' => $model-><?= $primaryKey?>], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Está seguro que desea eliminar este registro?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>

        </div>
    </div>
</div>
