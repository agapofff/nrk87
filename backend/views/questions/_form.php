<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;

use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="questions-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
                ->field($model, 'name')
                ->textInput(['maxlength' => true])
        ?>

        <?= $form
                ->field($model, 'date_start')
                ->widget(DateControl::classname(), [
                    'type' => 'datetime',
                    'displayFormat' => 'php:d F Y, H:i',
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'saveTimezone' => 'Europe/Moscow',
                    'displayTimezone' => 'Europe/Moscow',
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'php:d F Y, H:i',
                            'minuteStep' => 10,
                        ],
                        'layout' => '{picker}{input}{remove}',
                        'options' => [
                            'placeholder' => Yii::t('back', 'Выберите дату и время')
                        ],
                    ],
                    'language' => 'ru',
                ]);
        ?>

        <?= $form
                ->field($model, 'date_end')
                ->widget(DateControl::classname(), [
                    'type' => 'datetime',
                    'displayFormat' => 'php:d F Y, H:i',
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'saveTimezone' => 'Europe/Moscow',
                    'displayTimezone' => 'Europe/Moscow',
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'php:d F Y, H:i',
                            'minuteStep' => 10,
                        ],
                        'layout' => '{picker}{input}{remove}',
                        'options' => [
                            'placeholder' => Yii::t('back', 'Выберите дату и время')
                        ],
                    ],
                    'language' => 'ru',
                ]);
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
