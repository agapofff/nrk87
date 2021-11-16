<?php

use yii\helpers\Html;

$this->title = Yii::t('back', 'Создать');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Розыгрыши'), 
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="scan-to-win-create">
            <br>
            <?= $this->render('_form', [
                'model' => $model,
                'products' => $products,
                'users' => $users,
                'codes' => $codes,
            ]) ?>
            <br>
        </div>
    </div>
</div>