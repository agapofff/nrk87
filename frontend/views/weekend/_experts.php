<?php
    use yii\helpers\Html;
?>

<section id="experts" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12 col-xl-4">
                <h2 class="display-1 my-5 text-nowrap">
                    <span class="bg-primary">
                        <strong>&nbsp;<?= Yii::t('front', 'Эксперты') ?>&nbsp;</strong>
                    </span>
                </h2>
                <div class="mt-5">
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
            <?php foreach ($experts as $expert) { ?>
                <div class="row">
                    <div class="col-12 col-md-5 col-xl-6 align-self-center">
                        <?= Html::img([$expert->image], [
                            'alt' => $expert->{'title_'.Yii::$app->language} . ' - ' . $expert->{'description_'.Yii::$app->language},
                            'class' => 'align-self-center mr-md-3 mr-lg-4 mr-xl-5 img-fluid'
                        ]) ?>
                    </div>
                    <div class="col-12 col-md-7 col-xl-6 align-self-center">
                        <?= Html::tag('h3', $expert->{'title_'.Yii::$app->language}, [
                            'class' => 'h2 mb-3 mb-md-4 mb-lg-5 font-weight-bold'
                        ]) ?>
                        <?= Html::tag('p', $expert->{'description_'.Yii::$app->language}, [
                            'class' => 'lead mb-3 mb-md-4 mb-lg-5 font-weight-normal'
                        ]) ?>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</section>