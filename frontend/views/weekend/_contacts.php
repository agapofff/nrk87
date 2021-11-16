<?php
    use yii\helpers\Html;
?>

<section id="contacts" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12">
                <div class="row justify-content-center align-items-start">
                    <div class="col-12 col-xl-4 mb-5 mb-xl-0">
                        <h2 class="display-1 mb-5">
                            <span class="bg-primary">
                                <strong>&nbsp;<?= Yii::t('front', 'Контакты') ?>&nbsp;</strong>
                            </span>
                        </h2>
                        <div class="my-2 my-md-3 my-lg-4 my-xl-5 py-md-1 py-md-2 py-lg-3">
                            <p class="h2 font-weight-bold">
                                <?= Html::a(Yii::t('front', '8 (800) 555—27—21'), 'tel:'.preg_replace('/[^0-9]/', '', Yii::t('front', '8 (800) 555—27—21')), [
                                    'class' => 'text-white text-decoration-none'
                                ]) ?>
                            </p>
                            <p class="h2 font-weight-bold">
                                <?= Html::a(Yii::t('front', 'info@f3tour.club'), 'mailto:'.Yii::t('front', 'info@f3tour.club'), [
                                    'class' => 'text-white text-decoration-none'
                                ]) ?>
                            </p>
                        </div>
                        <div class="mt-2 mt-md-3 mt-lg-4 mt-xl-5">
                            <?= Html::button(Yii::t('front', 'Регистрация'), [
                                'class' => 'btn btn-primary btn-lg rounded-pill text-light text-nowrap px-4',
                                'data' => [
                                    'target' => '#registration',
                                    'toggle' => 'modal',
                                    'title' => Yii::t('front', 'Регистрация'),
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8 pb-5 pb-xl-0">
                        <p class="h2 mb-4 text-primary"><?= Yii::t('front', 'Информация') ?></p>
                        <p class="list pl-4 position-relative mb-lg-4">
                            <?= Yii::t('front', 'Ограничение по возрасту: 18+'); ?>
                        </p>
                        <p class="list pl-4 position-relative mb-lg-4">
                            <?= Yii::t('front', 'Материалы, размещенные на сайте, носят информационный характер. Посетители сайта не должны использовать их в качестве медицинских рекомендаций. Предупреждаем о необходимости получения консультации у специалиста по оказываемым услугам и возможным противопоказаниям.'); ?>
                        </p>
                        <p class="list pl-4 position-relative mb-lg-4">
                            <?= Yii::t('front', 'Уважаемые посетители сайта, предупреждаем вас о том, что мы собираем метаданные пользователя (cookie, данные об IP-адресе и местоположении) для функционирования сайта. Если вы не хотите, чтобы эти данные обрабатывались, покиньте сайт.'); ?>
                        </p>
                        <p class="list pl-4 position-relative no-arrow mb-lg-4">
                            <?= Yii::t('front', 'ООО «Вижион Классик» ИНН 9710039506'); ?>
                            <br>
                            <?= Yii::t('front', 'РФ, 125047, г. Москва, ул. 4-я Тверская-Ямская, д. 24, эт. 1, пом. 1, комната 73'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>