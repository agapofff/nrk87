<?php
    use yii\helpers\Html;
?>

<section id="past_events" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12">
                <div class="row justify-content-center align-items-start">
                    <div class="col-12 col-xl-4">
                        <h2 class="display-1 mb-5">
                            <span class="bg-primary">
                                <strong>&nbsp;<?= Yii::t('front', 'Прошлые&nbsp;<br>&nbsp;события') ?>&nbsp;</strong>
                            </span>
                        </h2>
                        <div class="mt-5 mb-5 mb-xl-0">
                            <?= Html::button(Yii::t('front', 'Регистрация') . Html::tag('span', '', [
                                    'class' => 'icon-arrow'
                                ]), [
                                    'class' => 'btn btn-primary btn-lg rounded-pill text-light text-nowrap px-4 mt-2 mt-md-3 mt-lg-4 mt-xl-5',
                                    'data' => [
                                        'target' => '#registration',
                                        'toggle' => 'modal',
                                        'title' => Yii::t('front', 'Регистрация'),
                                    ]
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="row">
                            <div class="owl-carousel owl-theme" data-items="1-2-2-2-2-2" data-dots="true" data-nav="true" data-autoheight="false">
                            <?php
                                foreach ($pastEvents as $event){
                                    $link_parts = explode('/', explode('?', $event->{'video_'.Yii::$app->language})[0]);
                            ?>
                                <div class="col-12">
                                    <div class="video">
                                        <iframe src="https://www.youtube.com/embed/<?= array_pop($link_parts) ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <p class="h3 text-center mt-3">
                                        <span class="font-weight-bold"><?= $event->{'title_'.Yii::$app->language} ?></span> <span class="text-primary"><?= Yii::$app->formatter->asDate($event->event_date, 'dd/MM/yyyy') ?></span>
                                    </p>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>