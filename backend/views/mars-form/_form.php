<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="form">

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
            ->field($model, 'gender')
            ->radioList(
                [
                    1 => Yii::t('back', 'Мужской'),
                    0 => Yii::t('back', 'Женский'),
                ],
                [
                    'class' => 'btn-group',
                    'data-toggle' => 'buttons',
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<label class="btn btn-primary text-white ' . ($checked ? ' active' : '') . '">' .
                                Html::radio($name, $checked, [
                                    'value' => $value,
                                    'class' => 'btn-switch'
                                ]) . $label . 
                            '</label>';
                    },
                ]
            )
            ->label(Yii::t('back', 'Пол'), [
                'style' => 'display: block'
            ])
        ?>

        <?= $form
                ->field($model, 'country')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'language')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'age')
                ->textInput([
                    'type' => 'number',
                    'min' => 18,
                    'max' => 130,
                ])
        ?>

        <?= $form
                ->field($model, 'email')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'user_id')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'session')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'ip')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'saveAndExit')
                ->hiddenInput([
                    'class' => 'saveAndExit'
                ])
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-floppy-saved'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
            
            <?php if ($model->id){ ?>
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