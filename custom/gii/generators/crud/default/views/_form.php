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
preg_match_all('/((?:^|[A-Z])[a-z]+)/',$controllerName,$matches);
$controllerName = implode('-', array_map(function($word){ return strtolower($word); }, $matches[1]));

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
	<div class="panel panel-default">		
		<div class="panel-body">
    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
		
<?php 
	$rows = [];
	$cont = 1;
	$input = "";
?>
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
		
		$input .= "    <div class=\"col-sm-6\">\n";
        $input .= "        <?= " . $generator->generateActiveField($attribute) . " ?>\n";
		$input .= "    </div>\n";
		if($cont % 2 == 0){
			$str = "<div class=\"row\">\n";
			$str .= $input;
			$str .= "</div>\n\n";
			$rows[] = $str;
			$input = "";
		}
		$cont ++;
    }	
} ?>
<?php 
	if($input != "") $rows[] = $input;
	echo implode('', $rows);
?>
		</div>
		<div class="panel-footer">
			<div class="form-group">
				<?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Crear') ?> : <?= $generator->generateString('Editar') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				<?= "<?= " ?>Html::a('Cancelar', ['<?= $controllerName ?>/index'], ['class' => 'btn btn-warning']) ?>
			</div>
		</div>
    <?= "<?php " ?>ActiveForm::end(); ?>
	</div>
</div>
