<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('front', 'Помощь');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mt-1_5 px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mb-2 mb-md-7">
    <div class="row">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'Помощь') ?>
            </h1>
        </div>
    </div>
</div>
<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mb-2 mb-md-7">
    <div class="row mb-md-6">
        <div class="col-12 mb-3">
    <?php
        if ($models) {
            foreach ($models as $model) {
    ?>
                <a href="#help<?= $model->id ?>" class="text-uppercase font-weight-light text-decoration-none d-block mt-2 mt-md-3 help" data-toggle="collapse">
                    <span class="float-right">
                        <span>+</span>
                        <span>-</span>
                    </span>
                    <?= json_decode($model->name)->{Yii::$app->language} ?>
                </a>
                <hr class="mt-0_5 mt-lg-1_5 py-0">
                <div id="help<?= $model->id ?>" class="collapse mt-1_5 mb-2 mt-md-3 mb-md-5">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                            <?= json_decode($model->content)->{Yii::$app->language} ?>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <p>
                <?= Yii::t('front', 'Остались вопросы?') ?>
                <br>
                <?= Yii::t('front', 'Свяжитесь с нами по {0}email{1} или {2}телефону{3}', [
                        '<a href="mailto:' . Yii::$app->params['contacts']['email'] . '">',
                        '</a>',
                        '<a href="tel:' . preg_replace('/[D]/', '', Yii::$app->params['contacts']['phone']) . '">',
                        '</a>',
                    ])
                ?>
            </p>
        </div>
    </div>

</div>
