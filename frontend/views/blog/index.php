<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('front', 'Блог');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="mt-1_5" style="
    height: 55vw;
    background: url('/images/blog/mountains.jpg') center bottom /cover no-repeat;
">
    <div class="container-fluid px-lg-2 px-xl-3 px-xxl-5">
        <div class="row">
            <div class="col-12">
                <h1 class="ttfirsneue text-uppercase display-2 mb-0 position-relative d-inline-block">
                    <?= Yii::t('front', 'Блог') ?>

                    <div class="d-none d-sm-block" style="
                        position: absolute;
                        top: 15%;
                        left: 110%;
                        width: 400px;
                        float: left;
                        font-family: Helvetica;
                        font-size: 16px;
                        font-weight: normal;
                        line-height: 20.8px;
                        text-decoration: none;
                        text-transform: none;
                        text-align: left;
                    ">
                        <?= str_replace('|', '<br>', Yii::t('front', 'Свежие новости | проекта NRK87.')); ?>
                    </div>
                </h1>
            </div>
        </div>
    </div>
</div>

<div id="blog-container" class="position-relative px-0 py-5">
    <div class="marquee h2 font-weight-light text-white">
        <?= Yii::t('front', 'Температура') ?> 32
        &nbsp;&nbsp;&nbsp;
        12:32 <?= Yii::t('front', 'Лето') ?>
        &nbsp;&nbsp;&nbsp;
        <?= Yii::t('front', 'Следующий запуск на Марс 2 марта') ?>
        &nbsp;&nbsp;&nbsp;
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div id="blog" class="mx-auto col-md-10 col-lg-6 mt-7">
                <div id="blog-categories">
                    <a href="#all" class="blog-category d-inline-block mr-1_5 mb-1 text-white text-decoration-none" data-category="all">
                        <?= Yii::t('front', 'Все') ?>
                    </a>
            <?php
                foreach ($categories as $category) {
            ?>
                    <a href="#<?= $category->slug ?>" class="blog-category d-inline-block mr-1_5 mb-1 text-white text-decoration-none opacity-50" data-category="<?= $category->slug ?>">
                        <?= json_decode($category->name)->{Yii::$app->language} ?>
                    </a>
            <?php
                }
            ?>
                </div>
                <hr class="border-white mt-0_5 mb-2">
                <div id="blog-posts">
            <?php
                foreach ($posts as $post) {
            ?>
                    <div class="blog-post" data-category="<?= $post->category->slug ?>">
                        <a href="<?= Url::to(['/blog/' . $post->slug]) ?>" class="text-decoration-none" 
                            data-toggle="lightbox" 
                            data-title="<?= json_decode($post->name)->{Yii::$app->language} ?>" 
                            data-footer="<?= json_decode($post->publisher)->{Yii::$app->language} ?>, <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>" 
                            data-remote="<?= Url::to(['/blog/' . $post->slug]) ?> #blog-post"
                            data-modal-class="side p-0" 
                            data-modal-dialog-class="position-absolute top-0 bottom-0 right-0 max-vw-50 border-0 m-0" 
                            data-modal-content-class="m-0 border-0 vh-100 vw-50" 
                            data-modal-header-class="align-items-center flex-nowrap py-md-2 px-md-1 px-lg-2 px-xl-3" 
                            data-modal-title-tag="span" 
                            data-modal-title-class="ttfirsneue h5 m-0 font-weight-light" 
                            data-close-button-class="p-0 float-none" 
                            data-close-button-content="<svg width='53' height='53' viewBox='0 0 53 53' fill='none' xmlns='http://www.w3.org/2000/svg'><line x1='13.7891' y1='12.3744' x2='39.9521' y2='38.5373' stroke='black' stroke-width='2'></line><line x1='12.3749' y1='38.5379' x2='38.5379' y2='12.3749' stroke='black' stroke-width='2'></line></svg>" 
                            data-modal-body-class="h-100 overflow-y-scroll py-0 px-md-1 px-lg-2 px-xl-3 hide-h1" 
                            data-modal-footer-class="px-md-1 px-lg-2 px-xl-3 py-md-2" 
                        >
                            <div class="row py-0_5">
                                <div class="col-auto">
                                    <?= Html::img($post->getImage()->getUrl('140x140'), [
                                            'alt' => json_decode($post->name)->{Yii::$app->language}
                                        ])
                                    ?>
                                </div>
                                <div class="col">
                                    <div class="row h-100">
                                        <div class="col-12 align-self-start">
                                            <p class="blog-post-publisher text-white opacity-50">
                                                <?= json_decode($post->publisher)->{Yii::$app->language} ?>
                                            </p>
                                            <p class="blog-post-name text-white">
                                                <?= json_decode($post->name)->{Yii::$app->language} ?>
                                            </p>
                                        </div>
                                        <div class="col-12 align-self-end">
                                            <p class="blog-post-date mb-0 text-white opacity-50">
                                                <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                                            </p>                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr class="border-white my-2">
                    </div>
            <?php
                }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
