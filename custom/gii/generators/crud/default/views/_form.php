<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}
$controllerName = str_replace('app', '', str_replace("Controller", '', $generator->controllerClass));
preg_match_all('/((?:^|[A-Z])[a-z]+)/', $controllerName, $matches);
$controllerName = implode('-', array_map(function($word) {
            return strtolower($word);
        }, $matches[1]));

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3><?= "<?=" ?> Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
<?= "<?php " ?>$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
            ],
            ]); ?>

            <?php
            $rows = [];
            $cont = 1;
            $input = "";
            ?>
            <?php
            foreach ($generator->getColumnNames() as $attribute) {
                if (in_array($attribute, $safeAttributes)) {

                    $input .= "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";
                    if ($cont % 2 == 0) {
                        $str = "<div class=\"row\">\n";
                        $str .= $input;
                        $str .= "</div>\n\n";
                        $rows[] = $str;
                        $input = "";
                    }
                    $cont ++;
                }
            }
            ?>
<?php
if ($input != "")
    $rows[] = $input;
echo implode('', $rows);
?>
        </div>
        <div class = "panel-footer text-right">
                <?= "<?php" ?> if ($model->isNewRecord): ?>
                    <?= "<?=" ?> Html::submitButton("Guardar " . Html::tag('i', '', ['class' => 'fa fa-floppy-o']), ['class' => 'btn btn-success']) ?>
                <?= "<?php else: ?>\n" ?>
                    <?= "<?=" ?> Html::submitButton("Actualizar " . Html::tag('i', '', ['class' => 'fa fa-refresh']), ['class' => 'btn btn-success']) ?>
                <?= "<?php endif ?>\n" ?>
                <?= "<?=" ?> Html::a('Cancelar ' . Html::tag('i', '', ['class' => 'fa fa-mail-reply']), ['<?= $controllerName ?>/index'], ['class' => 'btn btn-warning']) ?>
        </div>
<?= "<?php " ?>ActiveForm::end(); ?>
    </div>
</div>
