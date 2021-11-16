<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;
use jino5577\daterangepicker\DateRangePicker;

$this->title = Yii::t('back', 'Заявки в экспедицию');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="pages-index">

    <?= Html::a(Html::tag('span', '', [
            'class' => 'glyphicon glyphicon-plus'
        ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
            'class' => 'btn btn-success'
        ]);
    ?>

    <?php Pjax::begin(); ?>
    
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                
                [
                    'attribute' => 'name',
                    'format' => 'raw',
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
                
                [
                    'attribute' => 'gender',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'gender',
                        [
                            0 => Yii::t('back', 'Женский'),
                            1 => Yii::t('back', 'Мужской'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($data){
                        return ($data->gender ? Yii::t('back', 'Мужской') : Yii::t('back', 'Женский'));
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'country',
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'language',
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'age',
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'email',
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'user_id',
                        ArrayHelper::map($users, 'id', 'username'), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($model) use ($users){
                        return ArrayHelper::index($users, 'id')[$model->user_id]->username;
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
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
