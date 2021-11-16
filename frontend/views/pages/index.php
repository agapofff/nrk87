<?php
    use yii\helpers\Html;
    use yii\web\View;
    
    $name = json_decode($model->name)->{Yii::$app->language};
    $text = json_decode($model->text)->{Yii::$app->language};
    
    $this->title = Yii::$app->params['title'] ?: $name;
    
    $h1 = Yii::$app->params['h1'] ?: $name;
?>

<div class="container">
    <div class="row">
        <?= Html::tag('h1', $h1, [
            'class' => 'text-center my-5 w-100',
        ]) ?>
        <div id="page-content" class="col-12">
            <?= $text ?>
        </div>
    </div>
</div>