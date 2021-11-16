<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScanToWinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Коды');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="scan-to-win-index">

    <?= Html::a(Html::tag('span', '', [
        'class' => 'glyphicon glyphicon-plus'
    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
        'class' => 'btn btn-success'
    ]) ?>

    <?php Pjax::begin(); ?>
        
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'value' => function($model) use ($codes){
                        return array_values(array_filter($codes, function($code, $key) use ($model){
                            return $code['id'] == $model->id;
                        }, ARRAY_FILTER_USE_BOTH))[0]['code'];
                    },
                    'format' => 'raw',
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
                    'filter' => ArrayHelper::map($codes, 'id', 'code'),
                ],
                
                [
                    'attribute' => 'user_id',
                    'value' => function($model) use ($users){
                        return array_values(array_filter($users, function($user, $user_id) use ($model){
                            return $user['id'] == $model->user_id;
                        }, ARRAY_FILTER_USE_BOTH))[0]['username'];
                    },
                    'format' => 'raw',
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
                    'filter' => ArrayHelper::map($users, 'id', 'username'),
                ],
                
                [
                    'attribute' => 'order_id',
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
                    'attribute' => 'status',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        [
                            0 => Yii::t('back', 'Не активирован'),
                            1 => Yii::t('back', 'Активирован'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($model){
                        return Html::a(
                            Html::tag('big', 
                                Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $model->status ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ])
                            ), [
                                'active',
                                'id' => $model->id
                            ], [
                                'class' => 'pjax'
                            ]);
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'created_at',
                    'format' => ['datetime', 'php:d F Y, H:i'],
                    'filter' => DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at',
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
