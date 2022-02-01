<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('front', 'Ошибка') . ' 404';

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mb-5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                404
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid mb-15 mt-5 px-lg-2 px-xl-3 px-xxl-5">    
    <div class="row mb-6">
        <div class="col-12">
            <h2 class="h1 mb-0 font-weight-light">
                <?= Yii::t('front', 'Упс') ?>... <?= Yii::t('front', 'Что-то пошло не так') ?>!
                <br>
                <?= Yii::t('front', 'Не волнуйтесь. Это не ваша вина') ?> :)
            </h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2">
            <?= Html::a(Yii::t('front', 'Вернуться на Главную'), Url::home(true), [
                    'class' => 'btn btn-primary d-block ttfirsneue text-uppercase py-1',
                    'title' => Yii::t('front', 'Вернуться на Главную'),
                ])
            ?>
        </div>
    </div>
</div>
