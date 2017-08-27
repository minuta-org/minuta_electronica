<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/site.css',
        'plugins/select-2/css/select2.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
    ];
    
    public $js = [
        'plugins/select-2/js/select2.min.js',
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
