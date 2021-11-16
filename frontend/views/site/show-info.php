<?php

	use yii\helpers\Url;
	use yii\helpers\Html;
    use yii\web\View;
    use yii\widgets\Pjax;

	$this->title = Yii::t('front', 'Марс ближе, чем ты думаешь') . ' - ' . Yii::$app->name;

?>

<?php
    Pjax::begin([
        'enablePushState' => false,
    ]);
?>

    <?= \lavrentiev\widgets\toastr\NotificationFlash::widget(); ?>
    
    <div class="container-fluid horizontal-parallax">
    
        <?= Html::img('/images/show-smoke.png', [
                'style' => '
                    position: absolute;
                    top: 0;
                    left: -20%;
                    right: -20%;
                    display: block;
                    width: 140%;
                    min-width: 1300px;
                    z-index: 0;
                    pointer-events: none;
                ',
            ])
        ?>

        <div class="row justify-content-center">
        
            <div class="col-12 col-md-10 col-lg-9 col-xl-8">

                <h1 class="acline font-weight-light my-5 display-2 text-center">
                    <?= Yii::t('front', 'Марс ближе, чем ты думаешь') ?>
                </h1>
                
            </div>
            
            <div class="col-12 col-md-10 col-lg-8 col-xl-5">
        
                <p class="lead text-center">
                    <?= Yii::t('front', 'Заполни специальную форму, и мы включим тебя в список кандидатов для участия в нашей марсианской экспедиции.') ?>
                </p>
                
                <h3 class="text-center my-5">
                    <?= Yii::t('front', 'Выиграй приглашение на fashion-show NRK87.') ?>
                </h3>
                
                <p>
                    <?= Yii::t('front', '01 июля 2021 в 19:00 ракета NRK87. стартует с космодрома в Studio Hall.') ?>
                </p>
                
                <p>
                    <?= Yii::t('front', 'Премьерный эксклюзивный показ новой коллекции одежды для жизни на Марсе!') ?>
                </p>
                
                <p>
                    <?= Yii::t('front', 'Мы разыгрываем 5 пригласительных билетов: чтобы стать обладателем одного из них, зарегистрируйся на {0}, отметив в форме регистрации, что участвуешь в розыгрыше.', [
                        Html::a(Url::home(true), Url::home(true))
                    ]) ?>
                </p>
                
                <p>
                    <?= Yii::t('front', 'Еще одно обязательное условие — подписка на все наши соцсети (см. внизу).') ?>
                </p>
                
                <h3 class="text-center my-5">
                    <?= Yii::t('front', 'Твое путешествие на Марс начинается!') ?>
                </h3>
                
            </div>
            
            <div class="col-12 text-center my-5">
            <?php
                if (Yii::$app->user->isGuest){
                    echo Html::a(Html::tag('span') . Yii::t('front', 'Зарегистрироваться'), [
                            '/register'
                        ], [
                            'class' => 'btn btn-nrk ml-4',
                            'title' => Yii::t('front', 'Зарегистрироваться'),
                        ]);
                } else {
                    echo Html::beginForm(Url::current(), 'post', ['data-pjax' => true]);
                    echo Html::submitButton(Html::tag('span') . Yii::t('front', 'Зарегистрироваться'), [
                            'class' => 'btn btn-nrk ml-4',
                            'title' => Yii::t('front', 'Зарегистрироваться'),
                        ]);
                    echo Html::endForm();
                }
            ?>
                
            </div>
            
        </div>
        
    </div>

<?php
    Pjax::end();
?>