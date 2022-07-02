<?php
namespace dvizh\shop\assets;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        '@frontend/web/js/site.js',
        // 'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/modification-construct.js',
    ];
    
    public $css = [
        'css/modification-construct.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}
