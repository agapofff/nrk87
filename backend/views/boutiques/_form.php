<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;
    use yii\widgets\ActiveForm;
    use kartik\alert\AlertBlock;
    use kartik\switchinput\SwitchInput;
    use dvizh\gallery\widgets\Gallery;
?>

<?php Pjax::begin(); ?>

    <div class="boutiques-form">
    
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
            ]); ?>
        
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
                ->field($model, 'category')
                ->radioList(Yii::$app->params['boutiquePlaces'],
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
                ->label(Yii::t('back', 'Категория'), [
                    'style' => 'display: block'
                ])
            ?>

            <br>

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
                                'id' => 'boutiques_name_'.$lang->code,
                                'class' => 'form-control json_field',
                                'data' => [
                                    'field' => 'boutiques-name',
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
                            'id' => 'boutiques_description_'.$lang->code,
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
                                    'field' => 'boutiques-description',
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
            
            
            <?= $form
                    ->field($model, 'map')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>
            
            <?= $form
                    ->field($model, 'cssTop')
                    ->textInput([
                        'type' => 'number',
                        'min' => 0,
                        'max' => 100,
                    ])
            ?>
            
            <?= $form
                    ->field($model, 'cssLeft')
                    ->textInput([
                        'type' => 'number',
                        'min' => 0,
                        'max' => 100,
                    ])
            ?>
            
            <?= $form
                ->field($model, 'note_position')
                ->dropDownList([
                        0 => Yii::t('back', 'Справа сверху'),
                        1 => Yii::t('back', 'Справа снизу'),
                        2 => Yii::t('back', 'Слева снизу'),
                        3 => Yii::t('back', 'Слева сверху'),
                    ])
            ?>

            
            <br>
            
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
        
        <?php // формируем изображения заранее, до вывода на фронте ?>
        <div class="hidden">
        <?php
            $images = $model->getImages();
            if ($images) {
                foreach ($images as $image) {
        ?>
                    <img src="<?= $image->getUrl('500x') ?>">
                    <img src="<?= $image->getUrl('400x300') ?>">
                    <img src="<?= $image->getUrl('600x400') ?>">
                    <img src="<?= $image->getUrl('1500x') ?>">
        <?php
                }
            }
        ?>
        </div>        

    </div>

<?php Pjax::end(); ?>