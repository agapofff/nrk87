<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = !empty($results) ? Yii::t('back', 'Результаты голосования') : Yii::t('back', 'Голоса');
if (!empty($results)){
    $this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Вопросы'), 'url' => ['/questions']];
}
$this->params['breadcrumbs'][] = $this->title;

?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="votes-index">

    <?php if (empty($results)){ ?>
        <?= Html::a(Html::tag('span', '', [
            'class' => 'glyphicon glyphicon-plus'
        ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
            'class' => 'btn btn-success'
        ]) ?>
    <?php } ?>
    
<?php if (!empty($results)){ ?>
    <div id="vote-results">
        <br>
    <?php
        $sum = array_sum(ArrayHelper::getColumn($results, 'votes'));
        foreach ($results as $result){
            $percent = ($result['votes'] / $sum) * 100;
    ?>
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-lg-5 text-right">
                <?= Html::encode($result['name']) ?>
            </div>
            <div class="col-xs-12 col-sm-5 col-lg-4">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percent ?>%">
                        <?= $result['votes'] ?> <small>(<?= round($percent) ?>%)</small>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
        <br>
    </div>
<?php } ?>

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
                'attribute' => 'questions',
                'value' => 'questions.name',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => 'Поиск...'
                ],
                'headerOptions' => [
                    'valign' => 'middle',
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'valign' => 'middle',
                ],
            ],
            [
                'attribute' => 'answers',
                'value' => 'answers.name',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => 'Поиск...'
                ],
                'headerOptions' => [
                    'valign' => 'middle',
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'valign' => 'middle',
                ],
            ],
            [
                'attribute' => 'ip',
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => 'Поиск...'
                ],
                'headerOptions' => [
                    'valign' => 'middle',
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'valign' => 'middle',
                    'class' => 'text-center'
                ],
            ],
            // 'created_at',
            // 'updated_at',

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
