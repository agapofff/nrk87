<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="registration-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
                ->field($model, 'name')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'country')
                ->dropDownList(ArrayHelper::map($countries, 'id', 'name'))
                ->label(Yii::t('back', 'Страна'));
        ?>

        <?= $form
                ->field($model, 'phone')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'email')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'promocode')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'saveAndExit')
                ->hiddenInput(['class' => 'saveAndExit'])
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-floppy-saved'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
            
            <?php if ($model->id) { ?>
                <?= Html::submitButton(Html::tag('span', '', [
                    'class' => 'glyphicon glyphicon-floppy-remove'
                ]) . '&nbsp;' . Yii::t('back', 'Сохранить и закрыть'), [
                    'class' => 'btn btn-default btn-lg saveAndExit'
                ]) ?>
            <?php } ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end(); ?>