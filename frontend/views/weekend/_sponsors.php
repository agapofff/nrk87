<?php
    use yii\helpers\Html;
?>

<section id="sponsors" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12">
                <h2 class="display-1">
                    <span class="bg-primary">
                        <strong>&nbsp;<?= Yii::t('front', 'Спонсоры') ?>&nbsp;</strong>
                    </span>
                </h2>
                <div class="py-2 py-md-3 py-lg-4 py-xl-5">
                    <div class="row justify-content-center align-items-end text-center">
                        <div class="col-12 col-md-6 border-right border-primary py-md-4 divider">
                            <?= Html::img('/images/projectV.png', [
                                'alt' => 'projectV',
                                'class' => 'img-fluid'
                            ]) ?>
                            <p class="lead font-weight-bold mt-3">
                                <?= Html::a('www.projectv.group', 'https://projectv.group', [
                                    'target' => '_blank'
                                ]) ?>
                            </p>
                        </div>
                        <div class="col-12 col-md-6 py-md-4">
                            <?= Html::img('/images/coffeecell.png', [
                                'alt' => 'Coffeecell',
                                'class' => 'img-fluid'
                            ]) ?>
                            <p class="lead font-weight-bold mt-3">
                                <?= Html::a('www.coffeecell.com', 'https://coffeecell.com', [
                                    'target' => '_blank'
                                ]) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-lg-11 col-xl-10">
                        <p class="h1 fontweight-bold mb-5 mb-lg-0">
                            <?= Yii::t('front', '* БАД - НЕ ЯВЛЯЕТСЯ ЛЕКАРСТВЕННЫМ СРЕДСТВОМ') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>