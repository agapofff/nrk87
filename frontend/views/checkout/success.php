<?php
	use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
?>

<div class="container my-4 my-lg-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8">
            <h1 class="acline font-weight-light my-5 display-2 text-center">
                <?= Yii::t('front', 'Ваш заказ успешно оформлен') ?>
            </h1>
            <br>
            <h2 class="acline font-weight-light my-5 display-5 text-center">
                <?= Yii::t('front', 'Мы свяжемся с Вами в ближайшее время') ?>
            </h2>
            <br>
            <div class="text-center">
                <?= Html::a(Html::tag('span') . Yii::t('front', 'Вернуться на Главную'), Url::home(true),[
                        'class' => 'btn btn-nrk ml-3 mt-5',
                        'title' => Yii::t('front', 'Вернуться на Главную'),
                    ])
                ?>
            </div>
        </div>
    </div>
</div>

<?php
	$this->registerJs("
		ymPurchase('" . date('YmdHis') . "', '" . json_encode($products) . "', '" . Yii::$app->params['currency'] . "');
		fbqPurchase('" . json_encode($products) . "', '" . $sum . "', '" . Yii::$app->params['currency'] . "');
	", View::POS_READY);
?>