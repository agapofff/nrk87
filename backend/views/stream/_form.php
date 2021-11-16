<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Stream */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="stream-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
        <div class="checkbox">
            <?= $form
                    ->field($model, 'publish')
                    ->checkbox();
            ?>
        </div>

        <?= $form
                ->field($model, 'preview_ru')
                ->textInput([
                    'maxlength' => true,
                    'class' => 'form-control video-input'
                ])
        ?>
        <div id="stream-preview_ru-embed" class="form-group"></div>

        <?= $form
                ->field($model, 'preview_vi')
                ->textInput([
                    'maxlength' => true,
                    'class' => 'form-control video-input'
                ])
        ?>
        <div id="stream-preview_vi-embed" class="form-group"></div>

        <?= $form
                ->field($model, 'event_ru')
                ->textInput([
                    'maxlength' => true,
                    'class' => 'form-control video-input'
                ])
        ?>
        <div id="stream-event_ru-embed" class="form-group"></div>

        <?= $form
                ->field($model, 'event_vi')
                ->textInput([
                    'maxlength' => true,
                    'class' => 'form-control video-input'
                ])
        ?>
        <div id="stream-event_vi-embed" class="form-group"></div>

        <?= $form
                ->field($model, 'created_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'updated_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-ok'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end(); ?>