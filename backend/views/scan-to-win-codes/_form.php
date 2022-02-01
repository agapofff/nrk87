<?php

    use yii\helpers\Html;
    use yii\widgets\Pjax;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use kartik\alert\AlertBlock;
    use kartik\switchinput\SwitchInput;
    use kartik\datecontrol\Module;
    use kartik\datecontrol\DateControl;
?>

<?php Pjax::begin(); ?>

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <div class="scan-to-win-codes-form">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form
                    ->field($model, 'user_id')
                    ->dropDownList(ArrayHelper::map($users, 'id', 'username'))
            ?>

            <?= $form
                    ->field($model, 'order_id')
                    ->textInput()
            ?>

            <?= $form
                ->field($model, 'status')
                ->widget(SwitchInput::classname(), [
                    'pluginOptions' => [
                        'onText' => Yii::t('back', 'Да'),
                        'offText' => Yii::t('back', 'Нет'),
                        'onColor' => 'success',
                        'offColor' => 'danger',
                    ],
                ]);
            ?>

            <?= $form
                    ->field($model, 'created_at')
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
                                'minuteStep' => 1,
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