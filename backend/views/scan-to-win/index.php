<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;

use backend\models\ScanToWinCodes;

$scanToWinCodes = new ScanToWinCodes();

$this->title = Yii::t('app', 'Розыгрыши');
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

                // 'id',
                
                [
                    'attribute' => 'date_start',
                    'format' => ['datetime', 'php:d F Y, H:i'],
                    'filter' => DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_start',
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
                
                [
                    'attribute' => 'date_end',
                    'format' => ['datetime', 'php:d F Y, H:i'],
                    'filter' => DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_end',
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
                
                [
                    'attribute' => 'product_id',
                    'value' => function($model) use ($products){
                        return json_decode(ArrayHelper::getValue(ArrayHelper::map($products, 'id', 'name'), $model->product_id))->{Yii::$app->language};
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
                    'filter' => ArrayHelper::map($products, 'id', function($product){
                        return json_decode($product->name)->{Yii::$app->language};
                    }),
                ],
                
                [
                    'attribute' => 'winner_id',
                    'value' => function($model) use ($users){
                        return ArrayHelper::getValue(ArrayHelper::map($users, 'id', 'username'), $model->winner_id);
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
                    'attribute' => 'code_id',
                    'format' => 'raw',
                    'value' => function($model) use ($scanToWinCodes){
                        return $scanToWinCodes->getCode($model->code_id);
                    },
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
                    'attribute' => 'users_count',
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
                    'attribute' => 'codes_count',
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
                
                //'created_at',
                //'updated_at',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {codes} {delete}',
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
                        'codes' => function ($url, $model){
                            return Html::a('', '/admin/scan-to-win-codes?ScanToWinSearch[lottery_id]='.$model->id, [
                                'class' => 'glyphicon glyphicon-barcode btn btn-info btn-xs',
                                'title' => Yii::t('back', 'Коды'),
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
