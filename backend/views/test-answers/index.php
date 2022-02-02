<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;


$this->title = Yii::t('app', 'Ответы');

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Тесты'), 
    'url' => ['/tests']
];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="tests-index">

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
                    'attribute' => 'active',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'active',
                        [
                            0 => Yii::t('back', 'Нет'),
                            1 => Yii::t('back', 'Да'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(
                            Html::tag('big', 
                                Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $model->active ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
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
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(json_decode($model->name)->{Yii::$app->language}, [
                            'update',
                            'id' => $model->id,
                        ], [
                            'data-pjax' => 0,
                        ]);
                    },
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => 'Поиск...'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'question_id',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'question_id',
                        ArrayHelper::map($questions, 'id', function ($question) {
                            return json_decode($question['name'])->{Yii::$app->language};
                        }), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function ($model) use ($questions) {
                        $questionsName = json_decode(ArrayHelper::index($questions, 'id')[$model->question_id]->name)->{Yii::$app->language};
                        return Html::a($questionsName, [
                            '/test-questions/update',
                            'id' => $model->question_id,
                        ], [
                            'data-pjax' => 0,
                        ]);
                        
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'correct',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'correct',
                        [
                            0 => Yii::t('back', 'Нет'),
                            1 => Yii::t('back', 'Да'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(
                            Html::tag('big', 
                                Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $model->correct ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ])
                            ), [
                                'correct',
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
                
                // 'created_at',
                
                //'updated_at',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                                'title' => Yii::t('back', 'Изменить'),
                                'data-pjax' => 0,
                            ]);
                        },
                        'delete' => function ($url, $model) {
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
