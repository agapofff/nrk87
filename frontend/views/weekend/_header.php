<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    $parts = explode('.', Yii::$app->request->hostName);
    if ($parts[0] == 'www') unset($parts[0]);
    $parts = strpos(Yii::$app->request->hostName, '.loc') ? array_slice($parts, -2) : array_slice($parts, -3);
    $domain = implode('.', $parts);
// echo $domain;
?>

<nav class="navbar fixed-top bg-transparent px-lg-5">

    <div class="container-fluid px-lg-5">

        <?= Html::a(Html::img('/images/logo.png', [
                'alt' => Yii::$app->name
            ]), [Yii::$app->homeUrl], [
                'class' => 'navbar-brand'
            ])
        ?>
        
        <?= Html::tag('h5', Yii::t('front', 'бесплатный<br>семинар'), [
            'class' => 'navbar-text text-light mr-auto ml-2 mt-5 p-0 font-weight-bolder'
        ]) ?>
        
        <div id="langs" class="ml-auto position-relative mt-3">

    <?php
    /*
        foreach (Yii::$app->params['languages'] as $key => $lang){
            $active = $key == Yii::$app->language ? 'active' : '';
    ?>
            <div class="flag d-flex align-items-center justify-content-center <?= $active ?>">
    <?php
            if ($key == Yii::$app->language){
                echo Html::tag('span', $key) . Html::img('/images/langs/' . $key . '.png');
            } else {
                $subdomain = (isset($lang['alias']) && $lang['alias'] ? $lang['alias'] : $key) . '.';
                if (isset($lang['main']) && $lang['main']) $subdomain = '';
                $link = explode('//', Url::base(true))[0] . '//' . $subdomain . $domain . Yii::$app->request->url;
                echo Html::a(Html::tag('span', $key) . Html::img('/images/langs/' . $key . '.png'), $link, [
                    'title' => $lang['title'],
                    'class' => 'text-white'
                ]);
            }
    ?>
            </div>
    <?php
        }
        */
    ?>
        </div>

    </div>
    
</nav>