<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Вопросы');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>
    
<div class="questions-index">

    <?= Html::a(Html::tag('span', '', [
        'class' => 'glyphicon glyphicon-plus'
    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
        'class' => 'btn btn-success'
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
                'attribute' => 'name',
                'label' => Yii::t('back', 'Вопрос'),
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => 'Поиск...'
                ],
                'headerOptions' => [
                    'class' => 'text-center'
                ],
            ],

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
            //'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {answers} {results} {delete}',
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
                    'answers' => function ($url, $model){
                        return Html::a('', '/admin/answers?AnswersSearch[question_id]='.$model->id, [
                            'class' => 'glyphicon glyphicon-list btn btn-info btn-xs',
                            'title' => Yii::t('back', 'Ответы'),
                            'data-pjax' => 0,
                        ]);
                    },
                    'results' => function ($url, $model){
                        return Html::a('', '/admin/votes?VotesSearch[question_id]='.$model->id, [
                            'class' => 'glyphicon glyphicon-signal btn btn-warning btn-xs',
                            'title' => Yii::t('back', 'Результаты'),
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
