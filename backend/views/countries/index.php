<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;
use yii\web\UrlManager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CountriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Страны');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="countries-index">

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
            [
                'attribute' => 'id',
                'filter' => false,
            ],
            [
                'attribute' => 'publish',
                'label' => Yii::t('back', 'Активно'),
                'format' => 'raw',
                'filter' => false,
                'value' => function ($data) {
                    return Html::a(
                        Html::tag('big', 
                            Html::tag('span', '', [
                                'class' => 'glyphicon ' . ( $data->publish ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                            ])
                        ), [
                            'publish',
                            'id' => $data->id
                        ], [
                            'class' => 'pjax'
                        ]
                    );
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            /*
            [
                'attribute' => 'selected',
                'label' => Yii::t('back', 'По умолчанию'),
                'format' => 'html',
                'filter' => false,
                'value' => function ($data) {
                    return Html::a(
                        Html::tag('big', 
                            Html::tag('span', '', [
                                'class' => 'glyphicon ' . ( $data->selected ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                            ])
                        ), [
                            'select',
                            'id' => $data->id
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
            */
            [
                'attribute' => 'code',
                'label' => Yii::t('back', 'Код'),
                'value' => function ($data) {
                    return '+' . $data->code;
                },
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
                'attribute' => 'country_id',
                'label' => Yii::t('back', 'ID страны'),
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
                'attribute' => 'name',
                'label' => Yii::t('back', 'Страна'),
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
                'attribute' => 'lang',
                'label' => Yii::t('back', 'Язык'),
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
