<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

$this->title = Yii::t('front', 'Контакты') . ' - ' . json_decode($currentCountry->name)->{Yii::$app->language};

?>

<div class="container-fluid mb-1 mb-md-3 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'Контакты') ?>
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mb-1_5 mb-md-2">
    <div class="row justify-content-between flex-nowrap overflow-x-auto overflow-y-hidden product-types py-0_5">
<?php
    foreach ($countries as $countryKey => $country) {
?>
        <div class="col-auto">
            <?= Html::a(json_decode($country->name)->{Yii::$app->language}, [
                    '/contacts/' . $country->slug
                ], [
                    'class' => 'ttfirsneue text-uppercase text-decoration-none py-1 ' . ($country->id == $currentCountry->id ? 'text-dark' : 'text-gray-500'),
                ])
            ?>
        </div>
<?php
    }
?>
    </div>
    <hr class="d-none d-md-block mt-0">
</div>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mt-1_5 mb-md-2">
    <div class="row">
        <div class="col-12">
            <ul id="contacts-cities" class="nav nav-pills row" id="cities" role="tablist">
        <?php
            foreach ($cities as $cityKey => $city) {
        ?>
                <li class="nav-item col-auto" role="presentation">
                    <a href="#<?= $city->slug ?>" id="<?= $city->slug ?>-tab" class="nav-link display-5 px-0 bg-transparent text-dark ttfirsneue text-uppercase font-weight-light <?= $cityKey ? '' : 'active' ?>" data-toggle="tab" role="tab" aria-controls="cities" aria-selected="<?= $cityKey ? 'false' : 'true' ?>">
                        <?= json_decode($city->name)->{Yii::$app->language} ?>
                    </a>
                </li>
        <?php
            }
        ?>
            </ul>
        </div>
    </div>
</div>


<div class="tab-content">
<?php
    foreach ($cities as $cityKey => $city) {
?>
        <div id="<?= $city->slug ?>" class="tab-pane <?= $cityKey ? '' : 'active' ?>" role="tabpanel" aria-labelledby="<?= $city->slug ?>-tab">
            <div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mt-2 mb-1_5 mb-md-2">
    <?php
        foreach ($addresses as $addressKey => $address) {
            if ($address->city_id == $city->id) {
    ?>
                <div class="row">
                    <div class="col-md-4 col-lg-5 col-xl-6 mb-1_5 mb-md-2">
                        <p class="text-uppercase">
                            <?= Yii::t('front', 'Часы работы') ?>
                        </p>
                        <p class="mb-0_5">
                            <?= json_decode($address->worktime)->{Yii::$app->language} ?>
                        </p>
                    </div>
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <div class="row">
                            <div class="col-md-6 mb-1_5 mb-md-2">
                                <p class="text-uppercase">
                                    <?= Yii::t('front', 'Адрес') ?>
                                </p>
                                <div class="address cursor-pointer" data-coords="<?= $address->lat ?>,<?= $address->lon ?>">
                                    <p class="mb-0_5">
                                        <?= str_replace(array("\r\n", "\r", "\n"), '</p><p class="mb-0_5">',  strip_tags(json_decode($address->address)->{Yii::$app->language})) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1_5 mb-md-2">
                                <p class="text-uppercase">
                                    <?= Yii::t('front', 'Контакты') ?>
                                </p>
                                <p class="mb-0_5">
                                    <a href="tel:<?= preg_replace('/[D]/', '', $address->phone) ?>" class="text-decoration-none"><?= $address->phone ?></a>
                                </p>
                                <p class="mb-0_5">
                                    <a href="mailto:<?= $address->email ?>" class="text-decoration-none"><?= $address->email ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>
            </div>
        </div>
<?php
    }
?>

</div>

<div class="vw-100 vh-75">
    <div id="map" style="width:100%; height:100%;"></div>
</div>

<?php
    foreach ($cities as $cityKey => $city) {
        foreach ($addresses as $addressKey => $address) {
            if ($cityKey == 0 && $addressKey == 0) {
                $initMap = "myMap = new ymaps.Map('map', {
                                center: [" . $address->lat . ", " . $address->lon . "],
                                zoom: 16
                            });";
            }
            
            if ($address->city_id == $city->id) {
                $initMap .= "var city" . $city->id . "address" . $address->id . " = new ymaps.Placemark([
                                " . $address->lat . ", " . $address->lon . "
                            ], {
                                balloonContentHeader: '" . Yii::$app->id . "',
                                balloonContentBody: '<hr>' + 
                                '<p class=\"mb-0_5\">" . str_replace(array("\r\n", "\r", "\n"), '</p><p class=\"mb-0_5\">',  strip_tags(json_decode($address->address)->{Yii::$app->language})) . "</p>' +
                                '<hr>' + 
                                '<p class=\"mb-0_5\">" . $address->phone . "</p>' +
                                '<p class=\"mb-0_5\">" . $address->email . "</p>',
                            }, {
                                iconImageHref: '" . Url::to('/images/map_pointer.svg', true) . "',
                                iconImageSize: [88, 92],
                                iconImageOffset: [-65, -80]
                            });

                            myMap.geoObjects.add(city" . $city->id . "address" . $address->id . ");";
            }
        }
    }
    
    $this->registerJs("
        var myMap;
        
        initMap = function () {
            " . $initMap . "
        }
        
        setCenter = function (lat, lon) {
            myMap.setCenter([lat, lon]);
        }  
    ", View::POS_READY, 'maps');
    
    $this->registerJsFile("//api-maps.yandex.ru/2.0/?load=package.standard&lang=" . Yii::$app->language . "-" . strtoupper(Yii::$app->language) . "&onload=initMap");
    
    $this->registerJs("        
        $(document).on('click', '.address', function () {
            var coords = $(this).data('coords').split(',');
            setCenter(parseFloat(coords[0]), parseFloat(coords[1]));
        });
        
        $(document).on('click', '.nav-link', function () {
            $($(this).attr('href')).find('.address').trigger('click');
        });
    ", View::POS_READY);
?>
