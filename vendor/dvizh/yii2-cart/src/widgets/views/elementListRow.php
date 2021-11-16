<?php
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\DeleteButton;
use dvizh\cart\widgets\ElementPrice;
use dvizh\cart\widgets\ElementCost;

?>
<div class="pl-3 pr-2 cart-product" data-currency="<?= $currency ?>" data-id="<?= $model->comment ?>" data-name="<?= $name ?>" data-price="<?= round($model->price) ?>">
    <div class="row no-gutters">
        <div class="col-12 col-sm-8">
        
            <a href="<?= $url ?>" class="media text-decoration-none">
            
                <img src="<?= $image ?>" class="pr-3 mt-1">
                
                <div class="media-body">
                    <p class="mb-1 cart-product-name"><?= $name ?></p>

                    <?php
                        if ($options && !empty($allOptions)) {
                            $productOptions = '';
                            foreach ($options as $optionId => $valueId)
                            {
                                if ($optionId == 1){
                                    if ($optionData = $allOptions[$optionId]) {
                                        $option = $optionData['name'];
                                        $value = $optionData['variants'][$valueId];
                                        $productOptions .= Html::tag('div', Html::tag('strong', Yii::t('front', $option)) . ': ' . Html::tag('span', $value, [
											'class' => 'cart-product-variant'
										]));
                                    }
                                }
                            }
                            echo Html::tag('div', $productOptions, [
                                'class' => 'dvizh-cart-show-options'
                            ]);
                        }
                    ?>

                    <?php 
                        if (!empty($otherFields))
                        {
                            foreach ($otherFields as $fieldName => $field)
                            {
                                if (isset($product->$field)){
                                    echo Html::tag('p', Html::tag('small', $fieldName.': '.$product->$field));
                                }
                            }
                        }
                    ?>
                </div>
            </a>
            
        </div>
        <div class="col-8 col-sm-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-6 col-sm-12">
                    <?= ElementPrice::widget([
                        'model' => $model,
                        'currency' => $currency,
                    ]);
                    ?>
                </div>
                <div class="col-6 col-sm-12">
                    <?= ChangeCount::widget([
                        'model' => $model,
                        'showArrows' => $showCountArrows,
                        'actionUpdateUrl' => Url::to([$controllerActions['update']]),
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="shop-cart-delete col-4 col-sm-1 text-right pt-2 pt-sm-0">
            <?= DeleteButton::widget([
                    'model' => $model,
                    'deleteElementUrl' => Url::to([$controllerActions['delete']]),
                    'lineSelector' => 'list-group-item',
                    'cssClass' => 'delete',
                ])
            ?>
        </div>
    </div>
</div>
<hr>