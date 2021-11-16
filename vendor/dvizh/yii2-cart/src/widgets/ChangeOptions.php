<?php
namespace dvizh\cart\widgets;

use yii\helpers\Url;
use yii\helpers\Html;
use yii;

class ChangeOptions extends \yii\base\Widget
{
    const TYPE_SELECT = 'select';
    const TYPE_RADIO = 'radio';

    public $model = NULL;
    public $type = NULL;
    public $cssClass = '';
    public $defaultValues = [];

    public function init()
    {
        if ($this->type == NULL) {
            $this->type = self::TYPE_SELECT;
        }

        parent::init();

        \dvizh\cart\assets\WidgetAsset::register($this->getView());

        return true;
    }

    public function run()
    {
        if ($this->model instanceof \dvizh\cart\interfaces\CartElement) {
            $optionsList = $this->model->getCartOptions();
            $changerCssClass = 'dvizh-option-values-before';
            $id = $this->model->getCartId();
        } else {
            $optionsList = $this->model->getModel()->getCartOptions();
            $this->defaultValues = $this->model->getOptions();
            $id = $this->model->getId();
            $changerCssClass = 'dvizh-option-values';
        }

        if (!empty($optionsList)) {
            $i = 1;
            foreach ($optionsList as $optionId => $optionData) {
                if (!is_array($optionData)) {
                    $optionData = [];
                }
                
                $cssClass = "{$changerCssClass} dvizh-cart-option{$id} cart-option";

                $optionsArray = [];
                // if ($optionId == 1) $optionsArray = ['' => $optionData['name']];
                // $optionsArray = ['' => $optionData['name']];
                if (isset($optionData['variants'])) {
                    foreach ($optionData['variants'] as $variantId => $value) {
                        
                        if ($optionId == 3 && $value != Yii::$app->language){
                            continue;
                        }
                        
                        if ($optionId == 4 && $value != Yii::$app->params['store_types'][Yii::$app->params['store_type']]){
                            continue;
                        }
                        
                        $optionsArray[$variantId] = $value;
                    }
                }

                if ($this->type == 'select') {

                    if ($optionId == 1){
                        $list = Html::dropDownList('cart_options' . $id . '-' . $i,
                            array_key_first($optionsArray),
                            $optionsArray,
                            [
                                'data-href' => Url::toRoute([
                                    'cart/element/update',
                                    'lang' => Yii::$app->language,
                                    'store_type' => Yii::$app->params['store_type'],
                                ]),
                                'data-filter-id' => $optionId,
                                'data-name' => Html::encode($optionData['name']),
                                'data-id' => $id,
                                'class' => "form-control $cssClass",
                                'id' => 'option' . $optionId,
                            ]
                        );
                    } else {
                        $list = Html::input('hidden', 'cart_options' . $id . '-' . $i, array_key_first($optionsArray), [
                            'data-href' => Url::toRoute([
                                'cart/element/update',
                                'lang' => Yii::$app->language,
                                'store_type' => Yii::$app->params['store_type'],
                            ]),
                            'data-filter-id' => $optionId,
                            'data-name' => Html::encode($optionData['name']),
                            'data-id' => $id,
                            'class' => "form-control $cssClass",
                            'id' => 'option' . $optionId,
                        ]);
                    }
                } else {
                    $optionName = $optionId == 1 ? Yii::t('app', 'Выберите размер') : $optionData['name'];
                    $optionLabel = Html::tag('div', $optionName, [
                        'class' => 'dvizh-option-heading d-none',
                    ]);
                    $list = Html::radioList('cart_options' . $id . '-' . $i,
                        ($optionId == 1 ? 0 : array_key_first($optionsArray)),
                        $optionsArray,
                        [
                            'itemOptions' => [
                                'data-href' => Url::toRoute([
                                    'cart/element/update',
                                    'lang' => Yii::$app->language,
                                    'store_type' => Yii::$app->params['store_type'],
                                ]),
                                'data-filter-id' => $optionId,
                                'data-name' => Html::encode($optionData['name']),
                                'data-id' => $id,
                                'class' => $cssClass,
                                'labelOptions' => [
                                    'class' => 'btn btn-lg- rounded-0 btn-outline-primary mx-2 p-0 d-flex justify-content-center align-items-center active float-left',
                                    'style' => '
                                        width: 60px;
                                        height: 60px;
                                    ',
                                ],
                            ],
                        ]
                    );
                }

                if ($this->type == 'select'){
                    $options[] = Html::tag('div', $list, [
                        'class' => 'dvizh-option w-100'
                    ]);
                } else {
                    $options[] = Html::tag('div', $optionLabel . Html::tag('div', $list, [
                        'class' => 'dvizh-option dvizh-option-heading btn-group btn-group-toggle w-100 row px-2',
                        'data' => [
                            'toggle' => 'buttons',
                        ],
                    ]), [
                        'class' => ($optionId != 1 ? 'd-none' : '')
                     ]);
                }
                $i++;
            }
        } else {
            return null;
        }

        return Html::tag('div', implode('', $options), [
            'class' => 'dvizh-change-options ' . $this->cssClass
        ]);
    }

    private function _defaultValue($option)
    {
        if (isset($this->defaultValues[$option])) {
            return $this->defaultValues[$option];
        }

        return false;
    }
}
