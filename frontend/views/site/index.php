<?php
    use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    $title = Yii::$app->id . ' - ' . Yii::$app->name;

    $this->title = Yii::$app->params['title'] ?: $title;
    
    
    function getCoverId($lastId, $max) {
        do {
            $id = rand(1, $max);
        } while (
            $id == $lastId
        );
        return $id;
    }
    
    $coverId = getCoverId(Yii::$app->session->get('coverId'), 2);
    $coverIdMobile = getCoverId(Yii::$app->session->get('coverIdMobile'), 2);

    Yii::$app->session->set('coverId', $coverId);
    Yii::$app->session->set('coverIdMobile', $coverIdMobile);
?>
<!--
<div class="vw-100 vh-100 d-none d-md-block pointer-events-none" style="
    background: url('/images/main/banner_<?= $coverId ?>.jpg') center center / cover no-repeat;
"></div>
-->
<div class="vw-100 d-none d-md-block pointer-events-none">
    <?= Html::img('/images/main/banner_desktop_' . $coverId . '.jpg', [
            'class' => 'd-block w-100',
            'alt' => Yii::$app->id . ' - ' . Yii::$app->name,
            'loading' => 'lazy',
        ])
    ?>
</div>

<div class="vw-100 vh-100 d-md-none pointer-events-none" style="
    background: url('/images/main/banner_mobile_<?= $coverIdMobile ?>.jpg') center center / cover no-repeat;
"></div>

<!--
<div class="container-fluid mb-7 pb-0_5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-8 text-uppercase">
            <?= Yii::t('front', 'Находимся в Москве') ?>
            <br>
            <?= Yii::t('front', 'Работаем по всему миру') ?>
        </div>
        <div class="col-4 text-right">
            EST.2019
        </div>
    </div>
</div>
-->

<div class="container-fluid mb-md-10 pt-3 pt-md-5 pb-3 pb-md-5 mt-md-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
    background: url('/images/main/ellipse<?= Yii::$app->language == 'ru' ? '_ru' : '' ?>.png') center center /cover no-repeat;
">
    <div class="row">
        <div class="col-12 text-right">
            EST. 2018
        </div>
        <div class="col-12">
    <?php
        $text = explode('|', Yii::t('front', 'GPS-одежда | для тех, | кто мечтает | о Марсе'));
        foreach ($text as $k => $txt) {
    ?>
            <h1 class="ttfirsneue text-uppercase display-2 d-inline-block mb-0 w-100 position-relative <?= $k % 2 ? ($k == 3 && Yii::$app->language == 'ru' ? 'text-left' : 'text-md-right') : 'text-left' ?>">
                <?= trim($txt) ?>
                
                <?php
                    if ($k == 1) {
                ?>
                        <div class="d-none d-xl-block" style="
                            position: absolute;
                            top: 40px;
                            left: 15px;
                            max-width: 470px;
                            float: left;
                            font-family: Helvetica;
                            font-size: 16px;
                            font-weight: normal;
                            line-height: 20.8px;
                            text-decoration: none;
                            text-transform: none;
                            text-align: left;
                            opacity: .5;
                        ">
                            <?= Yii::t('front', 'Мы решили создать коллекцию одежды со встроенными GPS-трекерами, с помощью которых можно не только легко найти человека, но и связаться с ним в любую минуту. Вы сможете чувствовать себя спокойно и уверенно, а значит, появится время творить, мечтать и делать мир вокруг лучше.') ?>
                        </div>
                <?php
                    }
                ?>
            </h1>
    <?php
        }
    ?>
        </div>
    </div>
</div>

<div class="position-relative mt-2 mt-md-5 mb-5 mb-md-10 bg-warning pt-2 pb-4 pt-md-2 pb-md-5">
    <div class="marquee h3 m-0 font-weight-light text-white">
        <?= Yii::t('front', 'бегущая строка', [
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
        ]) ?>
    </div>
</div>

<div class="container-fluid pb-0_5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    <hr>
    <h2 class="h1 mt_1_5 ttfirsneue font-weight-light text-uppercase">
        <?= Html::a(Yii::t('front', 'Каталог'), ['/catalog'], [
                'class' => 'text-decoration-none'
            ]);
        ?>
    </h2>
</div>

<div class="container-fluid pb-0 px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mt-md-4">
    <div class="row list-products justify-content-center">
    <?php
        foreach ($products as $key => $product) {
    ?>
            <div class="col-12 col-md-6 mb-md-4 <?= $key > 7 ? 'd-none d-md-block' : '' ?>">
                <?= $this->render('@frontend/views/catalog/_product', [
                        'model' => $product,
                        'prices' => $prices,
                        'prices_old' => $prices_old
                    ])
                ?> 
            </div>
    <?php
        }
    ?>

        <div class="col-12 mt-2 text-center d-md-none">
            <?= Html::a(Yii::t('front', 'Смотреть еще'), ['/catalog'], [
                    'class' => 'btn btn-outline-primary text-uppercase px-2 py-1'
                ]);
            ?>
        </div>
    </div>
</div>

<div class="vw-100 h-auto mt-5 mt-md-8 mb-3 mb-md-12 position-relative">
    <?= Html::img('/images/main/banner_6.jpg', [
            'class' => 'd-none d-md-block w-100 pointer-events-none',
            'loading' => 'lazy',
        ])
    ?>
    <?= Html::img('/images/main/who_we_are_mobile.jpg', [
            'class' => 'd-block d-md-none w-100 pointer-events-none',
            'loading' => 'lazy',
        ])
    ?>
    <div class="container-fluid position-absolute pb-0_5 pl-lg-2 pl-xl-3 pl-xxl-5 pr-lg-2 pr-xl-3 pr-xxl-5 mt-1_5 mt-3 mt-md-4 mt-lg-5 mt-xl-6 mt-xxl-7" style="
        top: 0;
        left: 0;
    ">
        <div class="row justify-content-between">
            <div class="col-md-5">
                <h3 class="h1 mb-2 ttfirsneue text-uppercase font-weight-light text-white">
                    <?= Yii::t('front', 'Кто мы') ?>
                </h3>
            </div>
            <div class="col-md-7 col-lg-5 col-xl-4 col-xxl-3">
                <p class="text-white mb-5 mb-md-3">
                    <?= Yii::$app->id ?> - <?= Yii::t('front', 'fashion tech wear бренд') ?>. 
                    <?= Yii::t('front', 'Для тех, кто ищет себя, ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу. Своей миссией бренд {0} выбрал продвижение ценностей мира и ответственность за сохранение природы и судьбу человечества, предметное размышление о взаимосвязи прошлого и настоящего. И взгляд в будущее.', [
                        Yii::$app->id
                    ]) ?>
                </p>
                <div class="text-center text-md-right text-xl-left mr-md-2 mr-lg-1 mr-xl-0">
                    <?= Html::a(Yii::t('front', 'Узнать больше'), ['/about'], [
                            'class' => 'btn btn-outline-primary text-uppercase text-white border-light bg-transparent px-2 py-1'
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

