<?php

    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;
    use dvizh\order\widgets\OrderForm;
  
    use yii\web\View;
?>
<div class="container my-4 my-lg-5 pt-4 pt-lg-5">
    <div class="row">
        <div class="col col-sm-11 col-md-10 col-lg-8 mx-auto">
            <div class="row">
                <div class="col-12">
                    <?= ElementsList::widget([
                            'type' => 'checkout',
                            'currency' => $currency,
                            'lang' => Yii::$app->language,                
                        ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <?= CartInformer::widget([
                            'currency' => $currency
                        ]); ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
            
<?=OrderForm::widget();?>



<?php
    // $this->registerJs("
        // $(document).ajaxComplete(function (event, xhr){
            // var url = xhr && xhr.getResponseHeader('X-Redirect');
            // if (url) {
                // window.location.assign(url);
            // }
        // });
    // ",
    // View::POS_READY,
    // 'ajax-redirect');
?>