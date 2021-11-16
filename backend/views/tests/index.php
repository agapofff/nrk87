<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Тесты');
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
                    'value' => function($model){
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
                    'value' => function($model){
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
                    'template' => '{update} {questions} {delete}',
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
                        'questions' => function ($url, $model){
                            return Html::a('', '/admin/test-questions?TestQuestionsSearch[test_id]='.$model->id, [
                                'class' => 'glyphicon glyphicon-question-sign btn btn-info btn-xs',
                                'title' => Yii::t('back', 'Вопросы'),
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
