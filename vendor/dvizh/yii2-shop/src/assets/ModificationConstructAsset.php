<?php
namespace dvizh\shop\assets;

use yii\web\AssetBundle;

class ModificationConstructAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'js/site.js'
    ];
    
    public $js = [
        'js/modification-construct.js',
    ];

    public $css = [
        
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }

}
