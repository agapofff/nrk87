<?php

namespace dvizh\relations\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use yii;

class Constructor extends \yii\base\Widget
{
    public $model = null;
    public $inAttribute = 'relations';
    public $view = 'constructor';
    
    public function init()
    {
        \dvizh\relations\assets\RelationsAsset::register($this->getView());
    }

    public function run()
    {
        $js = '';
        
        if($relations = $this->model->getRelations()) {
            foreach($relations->all() as $related) {
                $js .= 'dvizh.relations.renderRow("'.str_replace('\\', '\\\\', $related::className()).'", "'.Html::encode($related->getId()).'", "'.Html::encode($related->getName()).'");';
            }
        }
        
        $this->getView()->registerJs($js);
        
        return $this->render($this->view, ['model' => $this->model]);
    }
}
