<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => [ 'tag' => false,]
        ],
    ]); ?>
    <div class="panel panel-info panel-filters">
        <div class="panel-heading">
            Filtros <i class="fa fa-filter"></i>
        </div>
        <div class="panel-body" style="display:none">
<?php
$count = 0;
$filas = [];
$inputs = "";
foreach ($generator->getColumnNames() as $attribute) {
    $count ++;
    $inputs .= "        <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    if($count % 2 == 0){
        $filas[] = "<div class=\"row\">\n{$inputs}</div>\n";
        $inputs = "";
    }    
}
if($inputs != ""){
    $filas[] = "<div class=\"row\">\n{$inputs}</div>\n";
}
echo implode('', $filas);
?>
        <div class="panel-footer text-right" style="display:none">
        <?= "<?= " ?> Html::submitButton('Buscar ' . Html::tag('i', '', ['class' => 'fa fa-search']), ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?> Html::resetButton('Limpiar ' . Html::tag('i', '', ['class' => 'fa fa-eraser']), ['class' => 'btn btn-info']) ?>
        </div>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
