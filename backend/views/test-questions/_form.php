<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;
    use yii\widgets\ActiveForm;
    use kartik\alert\AlertBlock;
    use kartik\switchinput\SwitchInput;
    use dvizh\gallery\widgets\Gallery;
?>

<?php Pjax::begin(); ?>

<div class="tests-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ]
        ]);
    ?>
    
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
                ->field($model, 'test_id')
                ->dropDownList(ArrayHelper::map($tests, 'id', function($test) {
                    return json_decode($test['name'])->{Yii::$app->language};
                }))
        ?>
        

        <?= $form
                ->field($model, 'name', [
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
                <a href="#name_<?= $lang->code ?>_tab" aria-controls="name_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang) {
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="name_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                <?= Html::input(
                        'text',
                        'name_'.$lang->code,
                        json_decode($model->name)->{$lang->code},
                        [
                            'class' => 'form-control json_field',
                            'data' => [
                                'field' => 'testquestions-name',
                                'lang' => $lang->code,
                            ]
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
                ->field($model, 'description', [
                    'labelOptions' => [
                        'style' => 'text-align: left; margin-bottom: 0;',
                    ]
                ])
                ->textarea([
                    'class' => 'is_json hidden'
                ])
        ?>
        <ul class="nav nav-pills nav-justified">
    <?php
        foreach ($languages as $key => $lang) {
    ?>
            <li <?php if ($lang->code == Yii::$app->language) {?>class="active"<?php } ?>>
                <a href="#description_<?= $lang->code ?>_tab" aria-controls="description_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang) {
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="description_<?= $lang->code ?>_tab">
                <?= \yii\imperavi\Widget::widget([
                        'id' => 'testquestions-description_'.$lang->code,
                        'value' => json_decode($model->description)->{$lang->code},
                        'plugins' => [
                            'fontcolor',
                        ],
                        'options' => [
                            'lang' => Yii::$app->language,
                            'buttonsHide' => [
                                // 'html',
                                'image',
                                'file',
                            ],
                            'minHeight' => 200,
                            'maxHeight' => 300,
                        ],
                        'htmlOptions' => [
                            'class' => 'json_field',
                            'data' => [
                                'field' => 'testquestions-description',
                                'lang' => $lang->code,
                            ]
                        ]
                    ]);
                ?>
            </div>
    <?php
        }
    ?>
        </div>
        

        <?= Gallery::widget([
                'model' => $model,
                'previewSize' => '300x300',
                'fileInputPluginOptions' => [
                    'showPreview' => false,
                ]
            ]);
        ?>
        
        <br>
        
        <br>
        <?= $form
                ->field($model, 'text_right', [
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
                <a href="#text_right_<?= $lang->code ?>_tab" aria-controls="text_right_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang) {
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="text_right_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                <?= Html::input(
                        'text',
                        'text_right_'.$lang->code,
                        json_decode($model->text_right)->{$lang->code},
                        [
                            'class' => 'form-control json_field',
                            'data' => [
                                'field' => 'testquestions-text_right',
                                'lang' => $lang->code,
                            ]
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
                ->field($model, 'text_wrong', [
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
                <a href="#text_wrong_<?= $lang->code ?>_tab" aria-controls="text_wrong_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang) {
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="text_wrong_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                <?= Html::input(
                        'text',
                        'text_wrong_'.$lang->code,
                        json_decode($model->text_wrong)->{$lang->code},
                        [
                            'class' => 'form-control json_field',
                            'data' => [
                                'field' => 'testquestions-text_wrong',
                                'lang' => $lang->code,
                            ]
                        ]
                    )
                ?>
            </div>
    <?php
        }
    ?>
        </div>
        
        
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