<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\components\web\WSideNavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    // NavBar::begin([
    //     'brandLabel' => Yii::$app->name,
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         'class' => 'navbar-inverse navbar-fixed-top',
    //     ],
    // ]);
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         ['label' => 'Administrativo', 'items' => [
    //             ['label' => 'Departamentos', 'url' => ['/departamentos/index']],
    //             ['label' => 'Municipios', 'url' => ['/municipios/index']],
    //             ['label' => 'Barrios', 'url' => ['/barrios/index']],
    //             ['label' => 'Matricula', 'url' => ['/matricula/index']],
    //             ['label' => 'Tipos de documento', 'url' => ['/tipos-documentos/index']],
    //             ['label' => 'Supervisores', 'url' => ['/supervisores/index']],
    //             ['label' => 'Recursos', 'url' => ['/recursos/index']],
    //         ]],
    //         Yii::$app->user->isGuest ? (
    //             ['label' => 'Login', 'url' => ['/site/login']]
    //         ) : (
    //             '<li>'
    //             . Html::beginForm(['/site/logout'], 'post')
    //             . Html::submitButton(
    //                 'Logout (' . Yii::$app->user->identity->username . ')',
    //                 ['class' => 'btn btn-link logout']
    //             )
    //             . Html::endForm()
    //             . '</li>'
    //         )
    //     ],
    // ]);
    // NavBar::end();
    ?>
    <div class="top-status-bar">
        <nav>
            <a href="#" class="brand">Mi aplicación</a>
            <ul class="menu-options">
                <li><a href="#"><i class="fa fa-power-off"></i> Salir</a></li>
            </ul>
            <ul class="status-icons">
                <li><a href="#"><i class="fa fa-bell"></i><span class="count">16</span></a></li>
                <li><a href="#"><i class="fa fa-bell"></i></a></li>
                <li><a href="#"><i class="fa fa-bell"></i></a></li>
            </ul>
        </nav>
    </div>
        <?= WSideNavBar::widget([
            'photo' => '@web/pics/jako.png',
            'title' => 'Alejandro',
            'subtitle' => 'Administrador',
            'options' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Administrativo', 'items' => [
                    ['label' => 'Departamentos', 'url' => ['/departamentos/index']],
                    ['label' => 'Municipios', 'url' => ['/municipios/index']],
                    ['label' => 'Barrios', 'url' => ['/barrios/index']],
                    ['label' => 'Matricula', 'url' => ['/matricula/index']],
                    ['label' => 'Tipos de documento', 'url' => ['/tipos-documentos/index']],
                    ['label' => 'Supervisores', 'url' => ['/supervisores/index']],
                    ['label' => 'Recursos', 'url' => ['/recursos/index']],
                ]],
                ['label' => 'Operaciones', 'items' => [                    
                    ['label' => 'Puestos', 'url' => ['/puestos/index']],
                    ['label' => 'Programacion supervisores', 'url' => ['/programacion-supervisores/index']],
                ]]
            ],
        ]); ?>

    <?= $this->blocks['bloque-auxiliar']; ?>    
    
    <div class="main-page-container">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>        
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
    </div>

    
</div>

<script>
    /**
     * Scripts para el menú
     */
    $(function(){
        $(".main-side-nav-bar .dropdown > a").click(function(){
            var clicked = $(this).parent();
            if(clicked.hasClass("opened")) {
                clicked.removeClass("opened");
                clicked.find(".submenu").slideUp();
                return false;
            }
            var opened = $(".dropdown.opened");
            opened.removeClass("opened");
            opened.find(".submenu").slideUp();
            clicked.toggleClass("opened");
            clicked.find(".submenu").slideToggle('fast');
            return false;
        });
    });
    /**
     * End escripts para el menú
     */

    $(function () {
        var panel = $(".panel-filters");
        panel.find(".panel-heading").click(function () {
            panel.find(".panel-body").slideToggle(function(){
                panel.find(".panel-footer").fadeToggle();
            });
        });
    });

    $(function(){
        $("select.select-2").select2({
            width : '100%',
        });
    });

    $(function(){
        $(".onchange-dependent").change(function(){            
            var comboPadre = $(this);
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['supervisores/ajax']) ?>',
                type: 'POST',
                data: {
                    ajx_rqst: true,
                    id: comboPadre.val(),
                    type: comboPadre.attr("data-type")
                }
            }).done(function(data){
                var comboHijo = $(comboPadre.attr("data-target"));
                comboHijo.html(data.html);
                if(comboHijo.hasClass("onchange-dependent")){
                    var hijoDelHijo = $(comboHijo.attr("data-target"));
                    var primeraOpcion = hijoDelHijo.find("option:first-child");
                    hijoDelHijo.html("");
                    hijoDelHijo.append(primeraOpcion);
                }
            });
        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
