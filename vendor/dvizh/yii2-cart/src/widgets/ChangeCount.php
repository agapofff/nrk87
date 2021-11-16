<?php
namespace dvizh\cart\widgets; 
use yii;
use yii\helpers\Url;
use yii\helpers\Html;

class ChangeCount extends \yii\base\Widget
{
    public $model = NULL;
    public $lineSelector = 'li'; //Селектор материнского элемента, где выводится элемент
    public $downArr = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>';
    public $upArr = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>';
    public $cssClass = 'dvizh-change-count';
    public $defaultValue = 1;
    public $showArrows = true;
    public $actionUpdateUrl = null;
    public $customView = false; // for example '@frontend/views/custom/changeCountLayout'
	
	// public $name = null;
	// public $currency = null;

    public function init()
    {
        parent::init();

        \dvizh\cart\assets\WidgetAsset::register($this->getView());
        
        return true;
    }

    public function run()
    {
        if($this->showArrows) {
            $downArr = Html::tag('div', Html::button($this->downArr, [
                'class' => 'btn btn-link px-0 cart-change-count minus',
                'style' => 'pointer-events: ' . ($this->model->count == 1 ? 'none' : 'normal'),
                'disabled' => ($this->model->count == 1 ? true : false),
            ]), [
                'class' => 'input-group-prepend dvizh-arr dvizh-downArr',
                'style' => 'pointer-events: ' . ($this->model->count == 1 ? 'none' : 'normal')
            ]);
            $upArr = Html::tag('div', Html::button($this->upArr, [
                'class' => 'btn btn-link px-0 cart-change-count plus',
            ]), [
                'class' => 'input-group-append dvizh-arr dvizh-upArr'
            ]);
        } else {
            $downArr = $upArr = '';
        }

        if(!$this->model instanceof \dvizh\cart\interfaces\CartElement) {
            $input = Html::activeTextInput($this->model, 'count', [
                'type' => ($this->showArrows ? 'text' : 'number'),
                'class' => 'dvizh-cart-element-count form-control border-0 px-0',
                'data-role' => 'cart-element-count',
                'data-line-selector' => $this->lineSelector,
                'data-id' => $this->model->getId(),
                'data-href' => $this->actionUpdateUrl,
                'min' => '1',
                'style' => ($this->showArrows ? 'pointer-events: none;' : ''),
            ]);
        } else {
            $input = Html::input('number', 'count', $this->defaultValue, [
                'class' => 'dvizh-cart-element-before-count form-control',
                'data-line-selector' => $this->lineSelector,
                'data-id' => $this->model->getCartId(),
                'min' => '1',
            ]);
        }
        
        $count = Html::tag('div', $this->model->count, [
            // 'class' => 
        ]);
        
        if ($this->customView) {
            return $this->render($this->customView, [
                'model' => $this->model,
                'defaultValue' => $this->defaultValue,
            ]);
        } else {
            return Html::tag('div', $downArr.$input.$upArr, [
                'class' => $this->cssClass . ($this->showArrows ? ' input-group justify-content-center mx-auto' : ''),
                'style' => 'width: 90px;',
            ]);
        }
    }
}
