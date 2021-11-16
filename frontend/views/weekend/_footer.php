<?php
    use yii\helpers\Html;
?>

<footer class="fixed-bottom px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center">
            <div class="col-4 col-xl-4 text-nowrap">
            <?php if (Yii::$app->language == 'ru'){ ?>
                <a href="https://www.facebook.com/f3forum/" target="_blank" class="btn-social fb mr-1 mr-sm-3"></a>
                <!-- <a href="#" target="_blank" class="btn-social ok"></a> -->
                <a href="https://vk.com/f3tour_online" target="_blank" class="btn-social vk mr-1 mr-sm-3"></a>
                <a href="https://www.instagram.com/f3events.online/ " target="_blank" class="btn-social insta mr-1 mr-sm-3"></a>
                <a href="https://www.youtube.com/channel/UCvWaJCIDjuykLUmuR_DrWHg/featured" target="_blank" class="btn-social youtube mr-1 mr-sm-3"></a>
            <?php } else { ?>
                <a href="https://www.facebook.com/vn.f3event.online" target="_blank" class="btn-social fb mr-1 mr-sm-3"></a>
                <a href="https://www.instagram.com/vn.f3event.online" target="_blank" class="btn-social insta mr-1 mr-sm-3"></a>
                <a href="https://www.youtube.com/channel/UC_T42kxGfTttLo4yNJBQ4-w/" target="_blank" class="btn-social youtube mr-1 mr-sm-3"></a>
            <?php } ?>
            </div>
            <div class="col-xl-4 d-none d-xl-block">
                <a href="https://drive.google.com/drive/folders/1xI7xhDnFDHstEov8-iDTQAydyr-lqmMc?usp=sharing" target="_blank" class="text-dark text-decoration-none">
                    <img src="/images/contacts/july/license.png" class="float-left">
                    <p class="lead ml-5 mt-3 text-nowrap">
                        &nbsp; <span class="text-underline"><?= Yii::t('front', 'Лицензии и сертификаты') ?></span>
                    </p>
                </a>
            </div>
            <div class="col-8 col-xl-4 text-right">
                <div id="phone" class="display-4 text-nowrap my-2">
                    <?= Html::a(Yii::t('front', '8 (800) 555—27—21'), 'tel:'.preg_replace('/[^0-9]/', '', Yii::t('front', '8 (800) 555—27—21')), [
                        'class' => 'text-dark text-decoration-none'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</footer>