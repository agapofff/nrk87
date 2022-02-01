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
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                //'id',
                
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
                    'value' => function($model) use ($users) {
                        return ArrayHelper::index($users, 'id')[$model->user_id]->username;
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'session',
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
                    'attribute' => 'ip',
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
                    'attribute' => 'test_id',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'test_id',
                        ArrayHelper::map($tests, 'id', function($test) {
                            return json_decode($test['name'])->{Yii::$app->language};
                        }), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($model) use ($tests) {
                        $testName = json_decode(ArrayHelper::index($tests, 'id')[$model->test_id]->name)->{Yii::$app->language};
                        return Html::a($testName, [
                            '/tests/update',
                            'id' => $model->test_id,
                        ], [
                            'data-pjax' => 0,
                        ]);
                        
                    },
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
                        ArrayHelper::map($questions, 'id', function($question) {
                            return json_decode($question['name'])->{Yii::$app->language};
                        }), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($model) use ($questions) {
                        $questionName = json_decode(ArrayHelper::index($questions, 'id')[$model->question_id]->name)->{Yii::$app->language};
                        return Html::a($questionName, [
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
                    'attribute' => 'answer_id',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'answer_id',
                        ArrayHelper::map($answers, 'id', function($answer) {
                            return json_decode($answer['name'])->{Yii::$app->language};
                        }), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($model) use ($answers) {
                        $answerName = json_decode(ArrayHelper::index($answers, 'id')[$model->answer_id]->name)->{Yii::$app->language};
                        return Html::a($answerName, [
                            '/test-answers/update',
                            'id' => $model->answer_id,
                        ], [
                            'data-pjax' => 0,
                        ]);
                        
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                //'created_at',
                //'updated_at',

                // ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
