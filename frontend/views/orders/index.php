<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use dvizh\order\Module;
?>

<div class="container">
    <div class="row">
        <div class="col-12 my-4 my-lg-5">
            <h1 class="display-2 acline text-center">
                <?= Yii::t('front', 'Заказы') ?>
            </h1>
        </div>
    </div>
<?php
    if ($orders){
?>
    <div class="row">
        <div class="col-12 my-4 my-lg-5">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">
                            <?= Yii::t('front', 'Заказ') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Дата') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Способ доставки') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Итого') ?>
                        </th>
                        <th class="text-center">
                            <?= Yii::t('front', 'Статус') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($orders as $order){
                ?>
                    <tr onclick="window.location.href='<?= Url::to(['/orders/' . $order->id]) ?>'" class="cursor-pointer">
                        <td class="text-center">
                                <?= $order->id ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::$app->formatter->asDate($order->date) ?>
                            <br>
                            <?= Yii::$app->formatter->asTime($order->time) ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::t('front', ArrayHelper::getValue(ArrayHelper::map($shippingTypes, 'id', 'name'), $order->shipping_type_id)) ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::$app->formatter->asCurrency($order->cost, Yii::$app->params['currency']) ?>
                        </td>
                        <td class="text-center">
                            <?= Yii::t('front', Yii::$app->getModule('order')->orderStatuses[$order->status]) ?>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    }
?>
</div>