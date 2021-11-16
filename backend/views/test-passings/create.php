<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TestPassings */

$this->title = Yii::t('app', 'Create Test Passings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Test Passings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-passings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
