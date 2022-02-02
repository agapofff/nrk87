<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Answers */

$this->title = Yii::t('back', 'Создать');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Ответы'), 
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

$model->created_at = Date('Y-m-d H:i:s');
$model->updated_at = Date('Y-m-d H:i:s');
?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="answers-create">
            <br>
            <?= $this->render('_form', [
                    'model' => $model,
                    'questions' => $questions,
                ])
            ?>
            <br>
        </div>
    </div>
</div>