<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-login">
    <div class="col-sm-12">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        #'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}<div class=\"col-sm-12\">{input}</div>\n<div class=\" col-sm-12\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-12 text-left control-label'],
                        ],
                    ]); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Nombre de usuario']) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Contraseña']) ?>
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-4 col-lg-8\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-block btn-success', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
