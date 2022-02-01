<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;
    use yii\widgets\ActiveForm;
    use kartik\alert\AlertBlock;
    use kartik\switchinput\SwitchInput;
?>

<?php Pjax::begin(); ?>

    <div class="scan-to-win-stores-form">
    
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form
                ->field($model, 'active')
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
                    ->field($model, 'store_id')
                    ->textInput()
            ?>

            <?= $form
                    ->field($model, 'name')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>

            <?= $form
                    ->field($model, 'currency')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>

            <?= $form
                    ->field($model, 'sum')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>

            <?= $form
                ->field($model, 'mlm')
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
                    ->field($model, 'description')
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