<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $model backend\models\Addresses */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

    <div class="addresses-form">

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
                    ->field($model, 'ordering')
                    ->hiddenInput()
                    ->label(false)
            ?>
            
            
            <?= $form
                    ->field($model, 'country_id')
                    ->dropDownList(ArrayHelper::map($countries, 'id', function ($country) {
                        return json_decode($country['name'])->{Yii::$app->language};
                    }))
            ?>
            
            
            <?= $form
                    ->field($model, 'city_id')
                    ->dropDownList(ArrayHelper::map($cities, 'id', function ($city) {
                        return json_decode($city['name'])->{Yii::$app->language};
                    }))
            ?>

            <?= $form
                    ->field($model, 'address', [
                        'labelOptions' => [
                            'style' => 'text-align: left; margin-bottom: 0;',
                        ]
                    ])
                    ->hiddenInput([
                        'class' => 'is_json'
                    ])
            ?>
            <ul class="nav nav-pills nav-justified">
        <?php
            foreach ($languages as $key => $lang) {
        ?>
                <li <?php if ($lang->code == Yii::$app->language) {?>class="active"<?php } ?>>
                    <a href="#address_<?= $lang->code ?>_tab" aria-controls="address_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                </li>
        <?php
            }
        ?>
            </ul>
            <div class="tab-content">
        <?php
            foreach ($languages as $key => $lang) {
        ?>
                <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="address_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                    <?= Html::textarea(
                            'address_'.$lang->code,
                            json_decode($model->address)->{$lang->code},
                            [
                                'id' => 'addresses_address_'.$lang->code,
                                'class' => 'form-control json_field',
                                'data' => [
                                    'field' => 'addresses-address',
                                    'lang' => $lang->code,
                                ],
                                'rows' => 3,
                                'style' => '
                                    resize: none;
                                ',
                            ]
                        )
                    ?>
                </div>
        <?php
            }
        ?>
            </div>
            <br>
            
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

            <br>
            <?= $form
                    ->field($model, 'worktime', [
                        'labelOptions' => [
                            'style' => 'text-align: left; margin-bottom: 0;',
                        ]
                    ])
                    ->hiddenInput([
                        'class' => 'is_json'
                    ])
            ?>
            <ul class="nav nav-pills nav-justified">
        <?php
            foreach ($languages as $key => $lang) {
        ?>
                <li <?php if ($lang->code == Yii::$app->language) {?>class="active"<?php } ?>>
                    <a href="#worktime_<?= $lang->code ?>_tab" aria-controls="worktime_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                </li>
        <?php
            }
        ?>
            </ul>
            <div class="tab-content">
        <?php
            foreach ($languages as $key => $lang) {
        ?>
                <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="worktime_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                    <?= Html::input(
                            'text',
                            'worktime_'.$lang->code,
                            json_decode($model->worktime)->{$lang->code},
                            [
                                'id' => 'addresses_worktime_'.$lang->code,
                                'class' => 'form-control json_field',
                                'data' => [
                                    'field' => 'addresses-worktime',
                                    'lang' => $lang->code,
                                ],
                            ]
                        )
                    ?>
                </div>
        <?php
            }
        ?>
            </div>
            <br>

            <?= $form
                    ->field($model, 'lat')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>

            <?= $form
                    ->field($model, 'lon')
                    ->textInput([
                        'maxlength' => true
                    ])
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