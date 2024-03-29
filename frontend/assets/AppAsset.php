<?php

namespace frontend\assets;
use yii\bootstrap4\BootstrapPluginAsset;

use yii\bootstrap4\BootstrapAsset;
use yii\web\JqueryAsset;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'build/app.css',
         
    ];
    public $js = [
        'build/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
