<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\alert\AlertBlock;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ScanToWin */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="scan-to-win-form">

    <?php $form = ActiveForm::begin(); ?>

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
                ->field($model, 'product_id')
                ->dropDownList(ArrayHelper::map($products, 'id', function ($model) {
                    return json_decode($model['name'])->{Yii::$app->language};
                }))
                ->label('Товар');
        ?>

        <?= $form
                ->field($model, 'winner_id')
                ->dropDownList(ArrayHelper::map($users, 'id', 'username'), [
                    'prompt' => ' --- ',
                ])
                // ->label(false)
        ?>

        <?= $form
                ->field($model, 'code_id')
                ->dropDownList(ArrayHelper::map($codes, 'id', 'code'), [
                    'prompt' => ' --- ',
                ])
        ?>

        <?= $form
                ->field($model, 'users_count')
                ->textInput([
                    'type' => 'number',
                    'min' => 0,
                    'max' => 999,
                ])
        ?>

        <?= $form
                ->field($model, 'codes_count')
                ->textInput([
                    'type' => 'number',
                    'min' => 0,
                    'max' => 999,
                ])
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


<?php Pjax::end() ?>