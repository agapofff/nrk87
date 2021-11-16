<?php
    use yii\helpers\Html;
?>

<section id="learn" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12">
                <h2 class="display-1 my-5">
                    <span class="bg-primary">
                        <strong>&nbsp;<?= Yii::t('front', 'Вы узнаете') ?>&nbsp;</strong>
                    </span>
                </h2>
                <div class="py-2 py-md-3 py-lg-4 py-xl-5">
                <?php foreach ($learns as $learn){ ?>
                    <p class="h4 list pl-4 position-relative"><?= $learn->{'title_'.Yii::$app->language} ?></p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>