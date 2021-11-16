<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    
    $title = Yii::t('front', 'Устройства GPS') . ' - ' . Yii::$app->name;
    $this->title = strip_tags(Yii::$app->params['title'] ?: $title);
?>

    <div class="container-fluid position-relative horizontal-parallax my-4 my-lg-5">
    
        <?= Html::img('/images/show-smoke.png', [
                'style' => '
                    position: absolute;
                    top: -30%;
                    left: -20%;
                    right: -20%;
                    display: block;
                    width: 140%;
                    min-width: 1300px;
                    z-index: 0;
                    pointer-events: none;
                ',
                'loading' => 'lazy',
            ])
        ?>

        <div class="row">
                    
            <div class="col-12 col-md-6 col-lg-5" style="min-height: 75vh">
            
                <?= Html::a(Html::tag('span') . Yii::t('front', 'Вернуться на Главную'), Url::home(true),[
                        'class' => 'btn btn-nrk ml-3 mt-5',
                        'title' => Yii::t('front', 'Вернуться на Главную'),
                    ])
                ?>
                
                <?= Html::img('/images/gps1.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: absolute;
                            top: 0;
                            left: 0;
                            z-index: 1;
                            pointer-events: none;
                            -webkit-transform: translate(-10%, -10%);
                            -moz-transform: translate(-10%, -10%);
                            transform: translate(-10%, -10%);
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/gps3.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: absolute;
                            top: 0;
                            left: 0;
                            -webkit-transform: translate(11%, 16%);
                            -moz-transform: translate(11%, 16%);
                            transform: translate(11%, 16%);
                            z-index: 2;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
            </div>
            
            <div class="col-11 col-md-6 col-lg-6 offset-lg-1 col-xl-5 offset-xl-1" style="z-index: 5">
                
                <h1 class="display-3 acline my-4 my-lg-5">
                    <?= json_decode($gps->name)->{Yii::$app->language} ?>
                </h1>
                
                <?= json_decode($gps->text)->{Yii::$app->language} ?>
                
            </div>
        
        </div>

    </div>