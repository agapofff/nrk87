<?php

use yii\web\View;
use yii\helpers\Html;

$this->title = Yii::t('front', 'О нас');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mb-1 mb-md-3 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'О нас') ?>
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid mt-5 px-lg-2 px-xl-3 px-xxl-5 position-relative d-none d-md-block">
    <div class="row">
        <div class="col-md-6">
            <nav id="about-nav" class="about-nav nav nav-pills flex-column sticky-top overflow-x-hidden" style="top: 100px">
                <a class="nav-link display-4 bg-none text-black my-1 px-5 py-1" href="#we">
                    <?= Yii::t('front', 'Мы') ?>
                </a>
                <a class="nav-link display-4 bg-none text-black my-1 px-5 py-1" href="#earth">
                    <?= Yii::t('front', 'Земля') ?>
                </a>
                <a class="nav-link display-4 bg-none text-black my-1 px-5 py-1" href="#mars">
                    <?= Yii::t('front', 'Марс') ?>
                </a>
                <a class="nav-link display-4 bg-none text-black my-1 px-5 py-1" href="#technology">
                    <?= Yii::t('front', 'Технологии') ?>
                </a>
                <a class="nav-link display-4 bg-none text-black my-1 px-5 py-1" href="#fgi">
                    <?= Yii::t('front', 'Freedom Int. Group') ?>
                </a>
            </nav>
        </div>
        <div id="about-content" class="col-md-6 col-xl-5 py-1">
            <div id="we" class="about-content opacity-50 pb-5">
                <p class="mb-0 font-weight-light">
                    <?= Yii::$app->id ?> &ndash; <?= Yii::t('front', 'fashion tech wear бренд') ?>. <?= Yii::t('front', 'Для тех, кто ищет себя, ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу. Своей миссией бренд {0} выбрал продвижение ценностей мира и ответственность за сохранение природы и судьбу человечества, предметное размышление о взаимосвязи прошлого и настоящего. И взгляд в будущее.', [
                            Yii::$app->id
                        ])
                    ?>
                </p>
            </div>
            <div id="earth" class="about-content opacity-50 pb-5">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Территория личной ответственности каждого из нас. Мы полагаем, что одежда, которая максимально близко прилегает к каждому человеку, может и должна напоминать об ответственности за свою жизнь, за своих  близких за планету в целом. Поэтому мы используем технологические инновации в наших вещах и поддерживаем принципы бережного отношения к окружающей среде.') ?>
                </p>
            </div>
            <div id="mars" class="about-content opacity-50 pb-5">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Марс – уже не сюжет из фантастического кино. И мы непременно будем на красной планете. Желание сделать лучше всегда приводило человечество к новым горизонтам. У нас есть такое желание. И значит, мы уверены в том, что технологии и вдохновение помогут нам позаботиться о близких, сохранить Землю для будущих поколений и сделать следующий шаг в освоении Вселенной.') ?>
                </p>
            </div>
            <div id="technology" class="about-content opacity-50 pb-5">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', '«Мы совместили натуральные полотна с высокотехнологичными тканями. Фактически создали синергию между уличным стилем и технической одеждой – это одна из главных особенностей {0} У марки есть ведущая айдентика и неиллюзорные задачи, связанные с Марсом, ряд которых уже выполняется – более подробно с реализациями миссий можно ознакомиться на официальном сайте бренда. Вся одежда обладает выверенными деталями, где нет случайных элементов. Начиная от шнура под вешалку на куртки, который сделан из альпинистской ткани и заканчивая приборами GPS, встроенными в коллекцию. Каждая вещь {0} – это исключительно лимитированное издание. Мы не содержим огромные фабрики и не размещаем заказ в больших цехах. Вся продукция {0} создаётся небольшой командой профессионалов. Мы не берём материалов больше, чем нужно, не растрачиваем понапрасну ресурс планеты и не используем вредных технологий»', [
                        Yii::$app->id
                    ]) ?>. <?= Yii::t('front', 'Эрик Амбар') ?> &ndash; <?= Yii::t('front', 'дизайнер одежды и креативный директор бренда') ?>.
                </p>
            </div>
            <div id="fgi" class="about-content opacity-50">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Бренд авторской одежды {0} входит в состав экосистемы международной инвестиционной компании Freedom International Group и находится под ее прямым управлением. Экосистема Freedom Group развивается в 17 государствах, включая США, Гонконг, Вьетнам и страны Европы. В инвестиционном портфеле компании – 48 проектов, общая стоимость активов оценивается в 2,5 млрд долларов.', [
                        Yii::$app->id
                    ]) ?> <?= Yii::t('front', 'Президент Freedom International Group') ?> &ndash; <?= Yii::t('front', 'Нарек Сираканян') ?>.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-2 d-md-none">
    <div class="row">
        <div class="col-12">
            <div class="about-nav">
                <a class="nav-link display-3 bg-none text-black mt-0_5 mb-1 px-1 py-0_5 opacity-100" href="#_we" data-toggle="collapse">
                    <?= Yii::t('front', 'Мы') ?>
                </a>
            </div>
            <div id="_we" class="collapse pb-1">
                <p class="mb-0 font-weight-light">
                    <?= Yii::$app->id ?> &ndash; <?= Yii::t('front', 'fashion tech wear бренд') ?>. <?= Yii::t('front', 'Для тех, кто ищет себя, ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу. Своей миссией бренд {0} выбрал продвижение ценностей мира и ответственность за сохранение природы и судьбу человечества, предметное размышление о взаимосвязи прошлого и настоящего. И взгляд в будущее.', [
                            Yii::$app->id
                        ])
                    ?>
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="about-nav">
                <a class="nav-link display-3 bg-none text-black mt-0_5 mb-1 px-1 py-0_5 opacity-100" href="#_earth" data-toggle="collapse">
                    <?= Yii::t('front', 'Земля') ?>
                </a>
            </div>
            <div id="_earth" class="collapse pb-1">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Территория личной ответственности каждого из нас. Мы полагаем, что одежда, которая максимально близко прилегает к каждому человеку, может и должна напоминать об ответственности за свою жизнь, за своих  близких за планету в целом. Поэтому мы используем технологические инновации в наших вещах и поддерживаем принципы бережного отношения к окружающей среде.') ?>
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="about-nav">
                <a class="nav-link display-3 bg-none text-black mt-0_5 mb-1 px-1 py-0_5 opacity-100" href="#_mars" data-toggle="collapse">
                    <?= Yii::t('front', 'Марс') ?>
                </a>
            </div>
            <div id="_mars" class="collapse pb-1">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Марс – уже не сюжет из фантастического кино. И мы непременно будем на красной планете. Желание сделать лучше всегда приводило человечество к новым горизонтам. У нас есть такое желание. И значит, мы уверены в том, что технологии и вдохновение помогут нам позаботиться о близких, сохранить Землю для будущих поколений и сделать следующий шаг в освоении Вселенной.') ?>
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="about-nav">
                <a class="nav-link display-3 bg-none text-black mt-0_5 mb-1 px-1 py-0_5 opacity-100" href="#_technology" data-toggle="collapse">
                    <?= Yii::t('front', 'Технологии') ?>
                </a>
            </div>
            <div id="_technology" class="collapse pb-1">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', '«Мы совместили натуральные полотна с высокотехнологичными тканями. Фактически создали синергию между уличным стилем и технической одеждой – это одна из главных особенностей {0} У марки есть ведущая айдентика и неиллюзорные задачи, связанные с Марсом, ряд которых уже выполняется – более подробно с реализациями миссий можно ознакомиться на официальном сайте бренда. Вся одежда обладает выверенными деталями, где нет случайных элементов. Начиная от шнура под вешалку на куртки, который сделан из альпинистской ткани и заканчивая приборами GPS, встроенными в коллекцию. Каждая вещь {0} – это исключительно лимитированное издание. Мы не содержим огромные фабрики и не размещаем заказ в больших цехах. Вся продукция {0} создаётся небольшой командой профессионалов. Мы не берём материалов больше, чем нужно, не растрачиваем понапрасну ресурс планеты и не используем вредных технологий»', [
                        Yii::$app->id
                    ]) ?>. <?= Yii::t('front', 'Эрик Амбар') ?> &ndash; <?= Yii::t('front', 'креативный директор бренда') ?>.
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="about-nav">
                <a class="nav-link display-3 bg-none text-black mt-0_5 mb-1 px-1 py-0_5 opacity-100" href="#_fgi" data-toggle="collapse">
                    <?= Yii::t('front', 'Freedom Int. Group') ?>
                </a>
            </div>
            <div id="_fgi" class="collapse pb-1">
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Бренд авторской одежды {0} входит в состав экосистемы международной инвестиционной компании Freedom International Group и находится под ее прямым управлением. Экосистема Freedom Group развивается в 17 государствах, включая США, Гонконг, Вьетнам и страны Европы. В инвестиционном портфеле компании – 48 проектов, общая стоимость активов оценивается в 2,5 млрд долларов.', [
                        Yii::$app->id
                    ]) ?> <?= Yii::t('front', 'Президент Freedom International Group') ?> &ndash; <?= Yii::t('front', 'Нарек Сираканян') ?>.
                </p>
            </div>
        </div>
    </div>
</div>

<img src="/images/about/about0.jpg" class="d-block mt-3 mt-lg-5 w-100">

<?php
    $this->registerJs("
        $('body').scrollspy({
            target: '#about-nav',
            offset: 400
        });
        
        function setActiveScrollBlock() {
            $('.about-content').addClass('opacity-50');
            $($('#about-nav .nav-link.active').attr('href')).removeClass('opacity-50');
        }
        setActiveScrollBlock();
        
        $(window).on('activate.bs.scrollspy', function (e) {
            setActiveScrollBlock();
        });
        
        $(document).on('click', '#about-nav .nav-link', function (e) {
            e.preventDefault();
            $([document.documentElement, document.body]).animate({
                scrollTop: $($(this).attr('href')).offset().top - 290
            }, 500);
        });
    ", View::POS_READY);
?>
