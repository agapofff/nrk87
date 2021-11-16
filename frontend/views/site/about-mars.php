<?php
    use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    $title = Yii::t('front', 'О Марсе');
    $this->title = Yii::$app->params['title'] ?: $title;
    
?>

    <div class="container position-relative ">

        <div class="row mt-4 mt-lg-5">
            
            <div class="col-12">
                <h1 class="display-1 acline my-4 my-lg-5 text-center">
                    <?= $title ?>
                </h1>
            </div>
        </div>
        
    </div>

    <div class="position-relative vw-100 vh-100">
        
        <div class="position-relative overflow-hidden vw-100 vh-100">
            <iframe id="youtube-mars" src="https://www.youtube.com/embed/A9OaQR1socI?controls=1&showinfo=0&rel=0&autoplay=1&loop=1&modestbranding=1&iv_load_policy=3&autohide=1&fs=0&cc_load_policy=0&disablekb=0&origin=<?= Url::home(true) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="position-absolute vw-100 vh-100"
                style="
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                "
            ></iframe>
        </div>
       
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-right">
                <p class="lead">
                    <?= Yii::t('front', 'Владимир Сурдин' ) ?>, <?= Yii::t('front', 'астроном') ?>
                </p>
            </div>
        </div>
    </div>