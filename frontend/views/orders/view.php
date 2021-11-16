<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use dvizh\order\Module;
    
    // echo \yii\helpers\VarDumper::dump($elements, 999, true); 
?>

<div class="container">
    <div class="row my-4 my-lg-5">
        <div class="col-12">
            <h1 class="display-3 acline text-center">
                <?= Yii::t('front', 'Заказ') ?> #<?= $order->id ?>
            </h1>
        </div>
    </div>
<?php
    if ($order){
?>
    <div class="row my-4 my-lg-5">
        <div class="col-12 col-md-6">
            <div class="dl-horizontal">
                <dt>
                    <?= Yii::t('front', 'Дата') ?>
                </dt>
                <dd>
                    <?= Yii::$app->formatter->asDate($order->date) ?>, <?= Yii::$app->formatter->asTime($order->time) ?>
                </dd>
                <dt>
                    <?= Yii::t('front', 'Статус') ?>
                </dt>
                <dd>
                    <?= Yii::$app->getModule('order')->orderStatuses[$order->status] ?>
                </dd>
            </div>
            <div class="dl-horizontal">
                <dt>
                    <?= Yii::t('front', 'Имя') ?>
                </dt>
                <dd>
                    <?= $order->client_name ?>
                </dd>
                <dt>
                    <?= Yii::t('front', 'Email') ?>
                </dt>
                <dd>
                    <?= $order->email ?>
                </dd>
                <dt>
                    <?= Yii::t('front', 'Телефон') ?>
                </dt>
                <dd>
                    <?= $order->phone ?>
                </dd>
            </div>
            <div class="dl-horizontal">
                <dt>
                    <?= Yii::t('front', 'Способ доставки') ?>
                </dt>
                <dd>
                    <?= Yii::t('front', ArrayHelper::getValue(ArrayHelper::map($shippingTypes, 'id', 'name'), $order->shipping_type_id)) ?>
                </dd>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="dl-horizontal">
        <?php
            foreach ($fields as $field){
                if ($fieldValue = ArrayHelper::getValue(ArrayHelper::map($fieldValues, 'field_id', 'value'), $field->id)){
        ?>
                    <dt>
                        <?= Yii::t('front', $field->description) ?>
                    </dt>
                    <dd>
                        <?= $field->id == 11 ? Yii::$app->formatter->asCurrency($fieldValue, $currency) : $fieldValue ?>
                    </dd>
        <?php
                    if ($field->id == 8 && $order->address){
        ?>
                        <dt>
                            <?= Yii::t('front', 'Адрес') ?>
                        </dt>
                        <dd>
                            <?= $order->address ?>
                        </dd>        
        <?php
                    }
                }
            }
        ?>

            </div>
        </div>

        <div class="col-12 my-4 my-lg-5">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-left">
                            <?= Yii::t('front', 'Товар') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Количество') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Цена') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Итого') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($elements as $key => $element){
                        $product_link = Url::to(['/product/' . $element->product->slug], true);
                ?>
                    <tr>
                        <td class="text-right">
                            <a href="<?= $product_link ?>">
                                <img src="<?= Url::to($element->product->getImage()->getUrl('60x60'), true) ?>">
                            </a>
                        </td>
                        <td class="text-left">
                            <p>
                                <a href="<?= $product_link ?>">
                                    <strong>
                                        <?= json_decode($element->name)->{$lang} ?>
                                    </strong>
                                </a>
                            </p>
                            <?= $sizes[$key] ?>
                        </td>
                        <td class="text-center">
                            <?= (int)$element->count ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::$app->formatter->asCurrency($element->price, $currency) ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::$app->formatter->asCurrency(($element->count * $element->price), $currency) ?>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-center">
                            <strong><?= Yii::t('front', 'Итого') ?></strong>:
                        </td>
                        <td class="text-center">
                            <?= Yii::$app->formatter->asCurrency($order->cost, $currency) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php
    }
?>
</div>