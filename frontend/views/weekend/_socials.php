<?php
    use yii\helpers\Html;
?>

<section id="socials" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12">
                <h2 class="display-1 my-5">
                    <span class="bg-primary">
                        <strong>&nbsp;<?= Yii::t('front', 'Соцсети') ?>&nbsp;</strong>
                    </span>
                </h2>
                <div class="row align-items-center justify-content-start pt-5">
                    <div class="col-auto my-3 mr-sm-5">
                        <span class="h2">
                            <strong>
                            <?= Yii::t('front', 'ПОДПИСЫВАЙТЕСЬ<br>НА НАШИ СОЦСЕТИ') ?>
                            </strong>
                        </span>
                    </div>
                    <div class="col-auto my-3">
                        <?php if (Yii::$app->language == 'ru'){ ?>
                            <a href="https://www.facebook.com/f3forum/" target="_blank" class="btn-social lg fb mr-4"></a>
                            <!-- <a href="#" target="_blank" class="socials__item ok"></a> -->
                            <a href="https://vk.com/f3tour_online" target="_blank" class="btn-social lg vk mr-4"></a>
                            <a href="https://www.instagram.com/f3events.online/ " target="_blank" class="btn-social lg insta mr-4"></a>
                            <a href="https://www.youtube.com/channel/UCvWaJCIDjuykLUmuR_DrWHg/featured" target="_blank" class="btn-social lg youtube mr-4"></a>
                        <?php } else { ?>
                            <a href="https://www.facebook.com/vn.f3event.online" target="_blank" class="btn-social lg fb mr-4"></a>
                            <a href="https://www.instagram.com/vn.f3event.online" target="_blank" class="btn-social lg insta mr-4"></a>
                            <a href="https://www.youtube.com/channel/UC_T42kxGfTttLo4yNJBQ4-w/" target="_blank" class="btn-social lg youtube mr-4"></a>
                        <?php } ?>
                    </div>
                    <div class="col-12 mt-4">
                        <?= Html::button(Yii::t('front', 'Регистрация') . Html::tag('span', '', [
                                'class' => 'icon-arrow'
                            ]), [
                                'class' => 'btn btn-primary btn-lg rounded-pill text-light text-nowrap px-4',
                                'data' => [
                                    'target' => '#registration',
                                    'toggle' => 'modal',
                                    'title' => Yii::t('front', 'Регистрация'),
                                ]
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>