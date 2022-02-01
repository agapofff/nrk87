<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Votes */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="votes-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
                ->field($model, 'question_id')
                ->dropDownList(ArrayHelper::map($questions, 'id', 'name'))
                ->label('Выберите вопрос');
        ?>

        <?= $form
                ->field($model, 'answer_id')
                ->dropDownList(ArrayHelper::map($answers, 'id', 'name'))
                ->label('Выберите ответ');
        ?>

        <?= $form
                ->field($model, 'ip')
                ->textInput(['maxlength' => true])
        ?>

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