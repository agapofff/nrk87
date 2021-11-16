<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Registration */

$this->title = Yii::t('back', 'Создать');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Регистрация'), 
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="registration-create">
            <br>
            <?= $this->render('_form', [
                'model' => $model,
                'countries' => $countries,
            ]) ?>
            <br>
        </div>
    </div>
</div>
