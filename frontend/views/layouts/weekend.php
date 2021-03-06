<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use yii\helpers\Html;
    use frontend\assets\AppAsset;
    use kartik\alert\AlertBlock;

    AppAsset::register($this);
    
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="content-type" content="text/html; charset=<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">
        <?php $this->registerCsrfMetaTags() ?>
        
        <title><?= Html::encode($this->title) ?></title>
        
        <?php $this->head() ?>
        
        <meta property="og:type" content="website">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="900" />
        <meta property="og:image:height" content="506" />
        
        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/images/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
        <meta name="yandex-verification" content="515f20dac8c39eed" />
    </head>
    
    <body>
        <?php $this->beginBody() ?>

        
            <?= AlertBlock::widget([
                    'type' => 'growl',
                    'useSessionFlash' => true,
                    'delay' => 1,
                ]);
            ?>
            
            <?= $content ?>

        <?php $this->endBody() ?>
    </body>
    
</html>

<?php $this->endPage() ?>
