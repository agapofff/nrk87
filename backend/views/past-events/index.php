<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PastEventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Прошедшие события');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="past-events-index">

    <?= Html::a(Html::tag('span', '', [
        'class' => 'glyphicon glyphicon-plus'
    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
        'class' => 'btn btn-success',
    ]) ?>

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
                'attribute' => 'title_ru',
                'label' => Yii::t('back', 'Название события'),
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => 'Поиск...'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            // 'title_vi',
            [
                'attribute' => 'event_date',
                'label' => Yii::t('back', 'Дата события'),
                'format' => ['datetime', 'php:d F Y'],
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'event_date',
                    'locale' => 'ru-RU',
                    'pluginOptions' => [
                        'format' => 'd.m.Y',
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
            // 'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'buttons' => [
                    'update' => function ($url, $model){
                        return Html::a('', $url, [
                            'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                            'title' => Yii::t('back', 'Изменить'),
                            'data-pjax' => 0,
                        ]);
                    },
                    'delete' => function ($url, $model){
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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
