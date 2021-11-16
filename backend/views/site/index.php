<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = Yii::$app->name;

$weekendItems = [];
$adminItems = [];
 
if (Yii::$app->user->can('/common/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Основные параметры'),
        'icon' => 'gear',
        'url' => '/common',
    ];
}

if (Yii::$app->user->can('/stream/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Онлайн-трансляция'),
        'icon' => 'youtube-play',
        'url' => '/stream',
    ];
}

if (Yii::$app->user->can('/experts/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Эксперты'),
        'icon' => 'trophy',
        'url' => '/experts',
    ];
}

if (Yii::$app->user->can('/learn/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Вы узнаете'),
        'icon' => 'graduation-cap',
        'url' => '/learn',
    ];
}

if (Yii::$app->user->can('/past-events/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Прошлые события'),
        'icon' => 'history',
        'url' => '/past-events',
    ];
}

if (Yii::$app->user->can('/questions/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Голосования'),
        'icon' => 'pie-chart',
        'url' => '/questions',
    ];
}

/*
if (Yii::$app->user->can('/answers/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Ответы'),
        'icon' => 'list-ul',
        'url' => '/answers',
    ];
}
if (Yii::$app->user->can('/votes/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Голоса'),
        'icon' => 'bar-chart',
        'url' => '/votes',
    ];
}
*/

if (Yii::$app->user->can('/registration/*')){
    $weekendItems[] = [
        'label' => Yii::t('back', 'Регистрация'),
        'icon' => 'user-plus',
        'url' => '/registration',
    ];
}

            
if (Yii::$app->user->can('/user/admin/*')){
    $adminItems[] = [
        'label' => Yii::t('back', 'Пользователи'),
        'icon' => 'users',
        'url' => '/user/admin',
    ];
}

if (Yii::$app->user->can('/rbac/*')){
    $adminItems[] = [
        'label' => Yii::t('back', 'Контроль доступа'),
        'icon' => 'key',
        'url' => '/rbac/role',
    ];
}

if (Yii::$app->user->can('/message/*')){
    $adminItems[] = [
        'label' => Yii::t('back', 'Локализация'),
        'icon' => 'globe',
        'url' => '/source-message',
    ];
}

if (Yii::$app->user->can('/countries/*')){
    $adminItems[] = [
        'label' => Yii::t('back', 'Страны (для формы)'),
        'icon' => 'flag',
        'url' => '/countries',
    ];
}

if (Yii::$app->user->can('/gii/*') && YII_ENV_DEV){
    $adminItems[] = [
        'label' => Yii::t('back', 'Gii'),
        'icon' => 'file-code-o',
        'url' => '/gii',
    ];
}

if (Yii::$app->user->can('/debug/*') && YII_ENV_DEV){
    $adminItems[] = [
        'label' => Yii::t('back', 'Debug'),
        'icon' => 'dashboard',
        'url' => '/debug',
    ];
}

function renderItem ($item){
    return Html::tag('div',
            Html::tag('div',
                Html::a(
                    Html::tag('div',
                        Html::tag('div', Html::tag('span', '', [
                            'class' => 'fa fa-' . $item['icon']
                        ]),[
                            'class' => 'h1'
                        ]) . Html::tag('h4', $item['label']),
                    [
                        'class' => 'panel-body'
                    ]),
                [$item['url']]),
            [
                'class' => 'panel panel-default'
            ]
        ),[
            'class' => 'col-xs-12 col-sm-6 col-md-4 col-lg-3'
        ]);
}

$this->registerCss('h1 { display: none; }');

?>
    <div class="site-index text-center">
<?php
    if (!empty($weekendItems)){
?>
        <div class="row text-center">
<?php
        echo Html::tag('h2', Yii::t('back', 'Weekend'));
        echo Html::tag('br');
        foreach ($weekendItems as $k => $item){
            echo renderItem($item);
        }
?>
        </div>
<?php
    }
    
    if (!empty($adminItems)){
        echo Html::tag('br');
?>
        <div class="row">
<?php
        echo Html::tag('h2', Yii::t('back', 'Администрирование'));
        echo Html::tag('br');
        foreach ($adminItems as $k => $item){
            echo renderItem($item);
        }
?>
        </div>
<?php
    }
?>
    </div>
