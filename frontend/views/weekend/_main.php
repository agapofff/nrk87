<?php
    use yii\helpers\Html;
?>

<section id="main" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center vh-100 position-relative">
            <div class="col-12 col-lg-4 align-self-end align-self-lg-center">
            <?= klisl\languages\widgets\ListWidget::widget() ?>
                <h4 class="display-2 text-nowrap">
                    <span class="font-weight-bold"><?= Yii::$app->formatter->asDate($common->{'datetime_'.Yii::$app->language}, 'dd') ?></span>/<?= Yii::$app->formatter->asDate($common->{'datetime_'.Yii::$app->language}, 'MM') ?> — <?= Yii::$app->formatter->asTime($common->{'datetime_'.Yii::$app->language}, 'HH:mm') ?>
                </h4>
                <h3 class="display-3 mt-4">
                    <span class="bg-primary font-weight-bolder text-nowrap">
                        &nbsp;<?= str_replace("\n", '&nbsp;<br>&nbsp;', $common->{'title_'.Yii::$app->language}) ?>&nbsp;
                    </span>
                </h3>
            </div>
            <div id="main-image" class="col-sm-6 col-md-5 col-lg-4 d-none d-sm-block align-self-end pb-4">
                <?= Html::img($common->image, [
                    'alt' => Yii::$app->formatter->asText($common->{'title_'.Yii::$app->language}),
                    'class' => 'img-fluid mb-5'
                ]) ?>
            </div>
            <div class="col-12 col-lg-4 text-center text-lg-right pr-lg-0 align-self-start align-self-lg-center">
                <div class="row justify-content-center justify-content-sm-start justify-content-lg-end">
                    <div class="col-12 col-sm-6 col-md-5 col-lg-10 col-xl-9 pr-lg-0">
                    <?php if ($stream->publish) { ?>
                        <?= Html::a(Yii::t('front', 'Смотреть трансляцию'), '#stream', [
                            'class' => 'btn btn-primary btn-lg btn-block rounded-pill text-light mt-5 scroll'
                        ]) ?>
                    <?php } ?>
                    
                        <?= Html::button(Yii::t('front', 'Регистрация'), [
                            'class' => 'btn btn-primary btn-lg btn-block rounded-pill text-light mt-5 text-nowrap',
                            'data' => [
                                'target' => '#registration',
                                'toggle' => 'modal',
                                'title' => Yii::t('front', 'Регистрация'),
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>