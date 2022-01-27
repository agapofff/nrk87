<?php
    use yii\helpers\Html;
    use yii\web\View;
    
    $name = json_decode($model->name)->{Yii::$app->language};
    $text = json_decode($model->text)->{Yii::$app->language};
    
    $this->title = Yii::$app->params['title'] ?: $name;
    
    $h1 = Yii::$app->params['h1'] ?: $name;
?>

<div class="container-fluid mb-5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <?= Html::tag('h1', $h1, [
            'class' => 'h3 mb-5 w-100 font-weight-light',
        ]) ?>
        <div id="page-content" class="col-12">
            <?= $text ?>
        </div>
    </div>
</div>