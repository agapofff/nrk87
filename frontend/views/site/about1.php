<?php

use yii\web\View;
use yii\helpers\Html;

$this->title = Yii::t('front', 'О нас');

// $this->params['breadcrumbs'][] = $this->title;


?>

<div class="container-fluid mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
	<div class="row">
		<div class="col-12">
			<h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
				<?= Yii::t('front', 'О нас') ?>
			</h1>
		</div>
		<div class="col-12 mt-5">
			<h2 class="display-3 mb-0 font-weight-light">
				<?= Yii::$app->id ?> - <?= Yii::t('front', 'fashion tech wear бренд') ?>. 
                <?= Yii::t('front', 'Для тех, кто ищет себя, ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу. Своей миссией бренд {0} выбрал продвижение ценностей мира и ответственность за сохранение природы и судьбу человечества, предметное размышление о взаимосвязи прошлого и настоящего. И взгляд в будущее.', [
                    Yii::$app->id
                ]) ?>
			</h2>
		</div>
	</div>
</div>

<div id="about-earth" class="position-relative">
    <?= Html::img('/images/about/earth.jpg', [
            'class' => 'd-block w-100',
        ])
    ?>
    <div class="container-fluid position-absolute left-0 right-0 mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
        top: 57%;
    ">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-9 offset-lg-3 col-xl-5 offset-xl-6 col-xxl-4 offet-xxl-6">
                <h2 class="ttfirsneue h2 mb-1 text-uppercase font-weight-light text-white">
                    <?= Yii::t('front', 'Земля') ?>
                </h2>
                <p class="mb-0 font-weight-light text-white">
                    <?= Yii::t('front', 'Территория личной ответственности каждого из нас. Мы полагаем, что одежда, которая максимально близко прилегает к каждому человеку, может и должна напоминать об ответственности за свою жизнь, за своих  близких за планету в целом. Поэтому мы используем технологические инновации в наших вещах и поддерживаем принципы бережного отношения к окружающей среде.') ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div id="about-mars" class="position-relative">
    <?= Html::img('/images/about/mars.jpg', [
            'class' => 'd-block w-100',
        ])
    ?>
    <div class="container-fluid position-absolute left-0 right-0 mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
        top: -10%;
    ">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-9 offset-lg-3 col-xl-6 offset-xl-3 col-xxl-4 offet-xxl-3">
                <h2 class="ttfirsneue h2 mb-1 text-uppercase font-weight-light">
                    <?= Yii::t('front', 'Марс') ?>
                </h2>
                <p class="mb-0 font-weight-light">
                    <?= Yii::t('front', 'Марс – уже не сюжет из фантастического кино. И мы непременно будем на красной планете. Желание сделать лучше всегда приводило человечество к новым горизонтам. У нас есть такое желание. И значит, мы уверены в том, что технологии и вдохновение помогут нам позаботиться о близких, сохранить Землю для будущих поколений и сделать следующий шаг в освоении Вселенной.') ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div id="about-technology" class="position-relative">
    <?= Html::img('/images/about/technology.jpg', [
            'class' => 'd-block w-100',
        ])
    ?>
    <div class="container-fluid position-absolute left-0 right-0 mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
        top: 0;
    ">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-9 offset-lg-3 col-xl-5 offset-xl-7 col-xxl-4 offet-xxl-7">
                <h2 class="ttfirsneue h2 mb-1 text-uppercase font-weight-light text-white">
                    <?= Yii::t('front', 'Технология') ?>
                </h2>
                <p class="font-weight-light text-white">
                    <?= Yii::t('front', '«Мы совместили натуральные полотна с высокотехнологичными тканями. Фактически создали синергию между уличным стилем и технической одеждой – это одна из главных особенностей {0} У марки есть ведущая айдентика и неиллюзорные задачи, связанные с Марсом, ряд которых уже выполняется – более подробно с реализациями миссий можно ознакомиться на официальном сайте бренда. Вся одежда обладает выверенными деталями, где нет случайных элементов. Начиная от шнура под вешалку на куртки, который сделан из альпинистской ткани и заканчивая приборами GPS, встроенными в коллекцию. Каждая вещь {0} – это исключительно лимитированное издание. Мы не содержим огромные фабрики и не размещаем заказ в больших цехах. Вся продукция {0} создаётся небольшой командой профессионалов. Мы не берём материалов больше, чем нужно, не растрачиваем понапрасну ресурс планеты и не используем вредных технологий»', [
                        Yii::$app->id
                    ]) ?>
                </p>
                <p class="font-weight-light text-white">
                    <strong><?= Yii::t('front', 'Эрик Амбар') ?></strong> - <?= Yii::t('front', 'креативный директор бренда') ?>.
                </p>
            </div>
        </div>
    </div>
</div>

<div id="about-fgi" class="position-relative mb-7">
    <?= Html::img('/images/about/nasa.jpg', [
            'class' => 'd-block w-100',
        ])
    ?>
    <div class="container-fluid position-absolute left-0 right-0 mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
        top: 7%;
    ">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-9 offset-lg-3 col-xl-6 offset-xl-3 col-xxl-4 offet-xxl-3">
                <h2 class="ttfirsneue h2 mb-1 text-uppercase font-weight-light text-white">
                    <?= Yii::t('front', 'FREEDOM GROUP') ?>
                </h2>
                <p class="font-weight-light text-white">
                    <?= Yii::t('front', 'Бренд авторской одежды {0} входит в состав экосистемы международной инвестиционной компании Freedom International Group и находится под ее прямым управлением. Экосистема Freedom Group развивается в 17 государствах, включая США, Гонконг, Вьетнам и страны Европы. В инвестиционном портфеле компании – 48 проектов, общая стоимость активов оценивается в 2,5 млрд долларов.', [
                        Yii::$app->id
                    ]) ?>
                </p>
                <p class="mb-0 font-weight-light text-white">
                    <?= Yii::t('front', 'Президент Freedom International Group') ?> - <?= Yii::t('front', 'Нарек Сираканян') ?>.
                </p>
            </div>
        </div>
    </div>
</div>
