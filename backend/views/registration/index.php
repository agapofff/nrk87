<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;
use jino5577\daterangepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Регистрации на мероприятия');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="registration-index">

    <!--
    <?= Html::a(Html::tag('span', '', [
        'class' => 'glyphicon glyphicon-plus'
    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
        'class' => 'btn btn-success'
    ]) ?>
    -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'name',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'country',
                'value' => 'countries.name',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск'),
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'phone',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'promocode',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'client_id',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'event',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск')
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'datetime',
                'format' => ['datetime', 'php:d F Y, H:i'],
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'datetime',
                    'locale' => 'ru-RU',
                    'pluginOptions' => [
                        'format' => 'd.m.Y 00:00:00',
                        'locale' => [
                            'applyLabel' => 'Применить',
                            'cancelLabel' => 'Отмена'
                        ],
                        'autoUpdateInput' => false
                    ],
                    'maskOptions' => [
                        'mask' => '99.99.9999 - 99.99.9999',
                    ],
                    'options' => [
                        'class' => 'form-control text-center',
                        'placeholder' => 'Поиск...'
                    ]
                ]),
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            /*
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'buttons' => [
                    'update' => function($url, $model){
                        return Html::a('', $url, [
                            'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                            'title' => Yii::t('back', 'Изменить'),
                            'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function($url, $model){
                        return Html::a('', $url, [
                            'class' => 'glyphicon glyphicon-trash btn btn-danger btn-xs',
                            'title' => Yii::t('back', 'Удалить'),
                            'data' => [
                                'pjax' => 0,
                                'confirm' => Yii::t('back', 'Вы уверены, что хотите удалить этот элемент?'),
                                'method' => 'post'
                            ]
                        ]);
                    },
                ]
            ],
            */
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
