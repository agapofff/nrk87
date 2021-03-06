<?php
    use yii\helpers\Html;
    use yii\web\View;
    
    $name = json_decode($model->name)->{Yii::$app->language};
    $text = json_decode($model->text)->{Yii::$app->language};
    
    $this->title = Yii::$app->params['title'] ?: $name;
    
    $h1 = Yii::$app->params['h1'] ?: $name;
?>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-12">
            <?= Html::tag('h1', $h1, [
                'class' => 'h3 mb-5 w-100 font-weight-light',
            ]) ?>
        </div>
        <div id="page-content" class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
            <?= $text ?>
        </div>
    </div>
</div>