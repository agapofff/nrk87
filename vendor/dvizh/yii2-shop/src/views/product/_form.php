<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dvizh\shop\models\Category;
use dvizh\shop\models\Producer;
use dvizh\gallery\widgets\Gallery;
use kartik\select2\Select2;
use dvizh\seo\widgets\SeoForm;
use kartik\alert\AlertBlock;
use kartik\switchinput\SwitchInput;
use kartik\file\FileInput;
use yii\grid\GridView;
use dosamigos\grid\columns\EditableColumn;
use yii\bootstrap\Modal;
use yii\web\View;

\dvizh\shop\assets\BackendAsset::register($this);


if ($model->isNewRecord){
    $model->available = 1;
    $model->is_new = 0;
    $model->is_popular = 0;
    $model->is_promo = 0;
}

$store_types = Yii::$app->params['store_types'];

?>

<div class="product-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php
        $form = ActiveForm::begin([
            'id' => 'product-form',
            'options' => [
                'enctype' => 'multipart/form-data',
                // 'class' => 'form-horizontal',
            ]
        ]);
    ?>
	
        <div class="form-group text-center hidden-xs hidden-sm hidden-md" style="
			position: fixed;
			top: 3px;
			z-index: 9999;
		">
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
    
        <br>
		
		<div class="row">
			<div class="col-6 col-md-4">
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
			</div>
			<div class="col-6 col-md-4">
				<?= $form
						->field($model, 'available')
						->widget(SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => Yii::t('back', 'Да'),
								'offText' => Yii::t('back', 'Нет'),
								'onColor' => 'success',
								'offColor' => 'danger',
							],
						]);
				?>
			</div>
			<div class="col-6 col-md-4">
				<?= $form
						->field($model, 'is_new')
						->widget(SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => Yii::t('back', 'Да'),
								'offText' => Yii::t('back', 'Нет'),
								'onColor' => 'success',
								'offColor' => 'danger',
							],
						]);
				?>
			</div>
			<div class="col-6 col-md-4">
				<?= $form
						->field($model, 'is_popular')
						->widget(SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => Yii::t('back', 'Да'),
								'offText' => Yii::t('back', 'Нет'),
								'onColor' => 'success',
								'offColor' => 'danger',
							],
						]);
				?>
			</div>
			<div class="col-6 col-md-4">
				<?= $form
						->field($model, 'is_promo')
						->widget(SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => Yii::t('back', 'Да'),
								'offText' => Yii::t('back', 'Нет'),
								'onColor' => 'success',
								'offColor' => 'danger',
							],
						]);
				?>
			</div>
			<div class="col-6 col-md-4">
				<?= $form
						->field($model, 'sort')
						->textInput([
							'type' => 'number'
						])
				?>
			</div>
		</div>
    
        <div class="hidden">
        <?= $form
                ->field($model, 'category_id')
                ->widget(Select2::classname(), [
                    'data' => Category::buildTextTree(),
                    'language' => 'ru',
                    'options' => [
                        'placeholder' => Yii::t('back', 'Выберите категорию')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        ?>
        </div>
        

        <br>
        <?php // предустановка категории, из которой сделан переход
            if (!$model->id && Yii::$app->request->get('category_id')){
                $model->category_ids = [Yii::$app->request->get('category_id')];
            }
        ?>
        <?= $form->field($model, 'category_ids')
                ->label(Yii::t('back', 'Категории'))
                ->widget(Select2::classname(), [
                    'data' => Category::buildTextTree(),
                    'theme' => Select2::THEME_DEFAULT,
                    // 'maintainOrder' => true,
                    'language' => 'ru',
                    'options' => [
                        'multiple' => true,
                        'placeholder' => Yii::t('back', 'Выберите категорию')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        ?>
        
        <div class="hidden">
        <?= $form
                ->field($model, 'producer_id')
                ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Producer::find()->all(), 'id', 'name'),
                    'language' => 'ru',
                    'options' => [
                        'placeholder' => Yii::t('back', 'Выберите бренд')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        ?>
        </div>
        
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
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#name_<?= $lang->code ?>_tab" aria-controls="name_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="name_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                <?= Html::input(
                        'text',
                        'name_'.$lang->code,
                        $model->id ? json_decode($model->name)->{$lang->code} : '',
                        [
                            'id' => 'product-name_'.$lang->code,
                            'class' => 'form-control json_field',
                            'data' => [
                                'field' => 'product-name',
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
                ->field($model, 'slug')
                ->textInput()
        ?>
        
        
        
        <br>
        <?= $form
                ->field($model, 'sku', [
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
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#sku_<?= $lang->code ?>_tab" aria-controls="sku_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="sku_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
            
                <?= Html::input(
                        'hidden',
                        'sku_'.$lang->code,
                        $model->id ? json_decode($model->sku)->{$lang->code} : '',
                        [
                            'id' => 'product-sku_'.$lang->code,
                            'class' => 'form-control json_field is_sub_json',
                            'data' => [
                                'field' => 'product-sku',
                                'lang' => $lang->code,
                            ]
                        ]
                    )
                ?>
                
                
                <ul class="nav nav-pills">
            <?php
                foreach ($store_types as $k => $store_type){
            ?>
                    <li <?php if ($k == 0){?>class="active"<?php }?>>
                        <a href="#sku_lang_<?= $lang->code ?>_store_<?= $k ?>_tab" aria-controls="sku_store_id_<?= $k ?>_tab" role="tab" data-toggle="tab"><?= $store_type ?></a>
                    </li>
            <?php
                }
            ?>
                </ul>
                <div class="tab-content">
            <?php
                foreach ($store_types as $k => $store_type){
            ?>
                    <div role="tabpanel" class="tab-pane <?php if ($k == 0){ ?>active<?php } ?>" id="sku_lang_<?= $lang->code ?>_store_<?= $k ?>_tab">
                    
                    <?= Html::input(
                            'text',
                            'sku_'.$lang->code.'_'.$k,
                            $model->id ? json_decode(json_decode($model->sku)->{$lang->code})->{$k} : '',
                            [
                                'id' => 'product-sku_'.$lang->code.'_'.$k,
                                'class' => 'form-control sub_json_field',
                                'data' => [
                                    'field' => 'product-sku_'.$lang->code,
                                    'key' => $k,
                                ]
                            ]
                        )
                    ?>
                    
                    </div>
            <?php
                }
            ?>  
                </div>
                
            </div>
    <?php
        }
    ?>
        </div>
        
        
        
        <br>
        <?= $form
                ->field($model, 'code')
                ->textInput()
        ?>
		
        <?= $form
                ->field($model, 'barcode')
                ->hiddenInput()
				->label(false)
        ?>
        
        
    <?php if (!$model->isNewRecord){ ?>
        <br>
        <?php Pjax::begin(); ?>
            <?= Gallery::widget([
                    'model' => $model,
                    'previewSize' => '300x300',
                    'fileInputPluginOptions' => [
                        'showPreview' => false,
                    ]
                ]);
            ?>
        <?php Pjax::end(); ?>
    <?php } ?>
        
    
    <?php if (!$model->isNewRecord){ ?>    
            <br>
            <br>
        <?php if ($model->video){ ?>
            <div id="product-video-embed" class="form-group" style="width:300px;">
                <label class="control-label" for="product-videofile">
                    <?= Yii::t('back', 'Видео') ?>
                </label>
                <video id="product-video-player" controls loop muted width="100%">
                    <source src="<?= $model->video ?>" type="video/<?= explode('.', $model->video)[1] ?>">
                </video>
                <button class="btn btn-danger video-remove">
                    <span class="fa fa-trash fa-xl"></span>
                </button>
            </div>
        <?php } ?>
            <div id="product-video-form" <?php if ($model->video){ ?> style="display:none" <?php } ?>>
            <?= $form
                    ->field($model, 'videoFile')
                    ->widget(FileInput::classname(), [
                        'options' => [
                            'accept' => 'video/*',
                        ],
                        'pluginOptions' => [
                            'showPreview' => false,
                        ]
                    ])
            ?>
            </div>
    <?php } ?>
        
        
        <br>
        <?= $form
                ->field($model, 'text', [
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
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#text_<?= $lang->code ?>_tab" aria-controls="text_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="text_<?= $lang->code ?>_tab">
                <?= \yii\imperavi\Widget::widget([
                        'id' => 'text_'.$lang->code,
                        'value' => ($model->id ? json_decode($model->text)->{$lang->code} : ''),
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
                            'minHeight' => 100,
                            'maxHeight' => 200,
                            // 'imageUpload' => Url::toRoute(['tools/upload-imperavi'])
                        ],
                        'htmlOptions' => [
                            'class' => 'json_field',
                            'data' => [
                                'field' => 'product-text',
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
                ->field($model, 'short_text', [
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
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#short_text_<?= $lang->code ?>_tab" aria-controls="short_text_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="short_text_<?= $lang->code ?>_tab">
                <?= \yii\imperavi\Widget::widget([
                        'id' => 'short_text_'.$lang->code,
                        'value' => ($model->id ? json_decode($model->short_text)->{$lang->code} : ''),
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
                            'minHeight' => 100,
                            'maxHeight' => 200,
                            // 'imageUpload' => Url::toRoute(['tools/upload-imperavi'])
                        ],
                        'htmlOptions' => [
                            'class' => 'json_field',
                            'data' => [
                                'field' => 'product-short_text',
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
		
		
		
        <br>
        <?= $form
                ->field($model, 'sizes', [
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
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#sizes_<?= $lang->code ?>_tab" aria-controls="sizes_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="sizes_<?= $lang->code ?>_tab">
                <?= \yii\imperavi\Widget::widget([
                        'id' => 'sizes_'.$lang->code,
                        'value' => ($model->id ? json_decode($model->sizes)->{$lang->code} : ''),
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
                            'minHeight' => 100,
                            'maxHeight' => 200,
                            // 'imageUpload' => Url::toRoute(['tools/upload-imperavi'])
                        ],
                        'htmlOptions' => [
                            'class' => 'json_field',
                            'data' => [
                                'field' => 'product-sizes',
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
                ->field($model, 'amount')
                ->hiddenInput()
                ->label(false)
        ?>





        <?php if (!$model->isNewRecord){ ?>
        
            <?php
                Pjax::begin([
                    'id' => 'product-modifications',
                    'enablePushState' => false
                ]);
            ?>
                <?php
                    if (isset($modificationDataProvider)){
                ?>
                        <ul id="tab-mod" class="nav nav-pills nav-justified">
                    <?php
                        foreach ($languages as $key => $lang){
                    ?>
                            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                                <a href="#modifications_lang_<?= $lang->code ?>_tab" aria-controls="modifications_lang_<?= $lang->code ?>_tab" role="tab" data-toggle="tab" class="tab-mod-lang" data-lang="<?= $lang->code ?>"><?= strtoupper($lang->code) ?></a>
                            </li>
                    <?php
                        }
                    ?>
                        </ul>
                        <div class="tab-content">
                    <?php
                        foreach ($languages as $key => $lang){
                    ?>
                            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="modifications_lang_<?= $lang->code ?>_tab">
                            
                                <ul class="nav nav-pills">
                            <?php
                                foreach ($store_types as $k => $store_type){
                            ?>
                                    <li <?php if ($k == 0){?>class="active"<?php }?>>
                                        <a href="#modifications_lang_<?= $lang->code ?>_store_<?= $k ?>_tab" aria-controls="modifications_store_id_<?= $k ?>_tab" role="tab" data-toggle="tab" class="tab-mod-store" data-store="<?= $k ?>"><?= $store_type ?></a>
                                    </li>
                            <?php
                                }
                            ?>
                                </ul>
                                <div class="tab-content">
                            <?php
                                foreach ($store_types as $k => $store_type){
                            ?>
                                    <div role="tabpanel" class="tab-pane <?php if ($k == 0){ ?>active<?php } ?>" id="modifications_lang_<?= $lang->code ?>_store_<?= $k ?>_tab">
                                        <?= GridView::widget([
                                            'dataProvider' => $modificationDataProvider,
                                            // 'filterModel' => $searchModificationModel,
                                            'summary' => false,
                                            'rowOptions' => function ($model, $key, $index, $grid) use ($lang, $k){
                                                if ($model->lang == $lang->code && $model->store_type == $k){
                                                    $class = '';
                                                } else {
                                                    $class = 'hidden';
                                                }
                                                return [
                                                    'key' => $key,
                                                    'index' => $index,
                                                    'class' => $class,
                                                ];
                                            },
                                            'tableOptions' => [
                                                'class' => 'table table-bordered',
                                                'style' => 'margin-bottom: 0;'
                                            ],
                                            'columns' => [
                                                [
                                                    'attribute' => 'name',
                                                    'format' =>'raw',
                                                    'value' => function($model){
                                                        return explode(' | ', $model->name)[0];
                                                    },
                                                    'contentOptions' => [
                                                        'class' => 'text-center text-bold',
                                                    ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                ],
                                                [
                                                    // 'class' => EditableColumn::className(),
                                                    'attribute' => 'sku',
                                                    // 'url' => ['/shop/modification/edit-field'],
                                                    // 'type' => 'text',
                                                    // 'label' => Yii::t('back', 'ID товара'),
                                                    // 'editableOptions' => [
                                                        // 'mode' => 'popup',
                                                    // ],
                                                    'contentOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                ],
                                                [
                                                    // 'class' => EditableColumn::className(),
                                                    'attribute' => 'code',
                                                    // 'url' => ['/shop/modification/edit-field'],
                                                    // 'type' => 'text',
                                                    // 'label' => Yii::t('back', 'Vendor Code'),
                                                    // 'editableOptions' => [
                                                        // 'mode' => 'popup',
                                                    // ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                ],
                                                
                                                [
                                                    'attribute' => 'available',
                                                    'format' => 'raw',
                                                    'contentOptions' => [
                                                        'class' => 'text-center'
                                                    ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                        'style' => 'min-width: 90px'
                                                    ],
                                                    // 'filter' => Html::activeDropDownList(
                                                        // $searchModel,
                                                        // 'available',
                                                        // [
                                                            // 0 => Yii::t('back', 'Нет'),
                                                            // 1 => Yii::t('back', 'Да'),
                                                        // ], [
                                                            // 'class' => 'form-control',
                                                            // 'prompt' => Yii::t('back', 'Все'),
                                                        // ]
                                                    // ),
                                                    'value' => function($model){
                                                        return Html::a(
                                                            Html::tag('big', 
                                                                Html::tag('span', '', [
                                                                    'class' => 'glyphicon ' . ( $model->available ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                                                ])
                                                            ), [
                                                                '/shop/modification/publish',
                                                                'id' => $model->id
                                                            ], [
                                                                'class' => 'pjax'
                                                            ]
                                                        );
                                                    },
                                                ],
                        
                                                [
                                                    // 'class' => EditableColumn::className(),
                                                    'attribute' => 'price',
                                                    'format' => 'integer',
                                                    'label' => Yii::t('back', 'Цена'),
                                                    // 'url' => ['/shop/modification/edit-field'],
                                                    // 'type' => 'number',
                                                    // 'editableOptions' => [
                                                        // 'mode' => 'popup',
                                                    // ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                    'contentOptions' => [
                                                        'class' => 'text-right text-nowrap',
                                                    ],
                                                ],
                                                
                                                [
                                                    // 'class' => EditableColumn::className(),
                                                    'attribute' => 'oldPrice',
                                                    // 'url' => ['/shop/modification/edit-field'],
                                                    // 'type' => 'text',
                                                    'label' => Yii::t('back', 'Старая цена'),
                                                    // 'editableOptions' => [
                                                        // 'mode' => 'popup',
                                                        // 'emptytext' => Yii::t('back', 'пусто'),
                                                    // ],
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                    'contentOptions' => [
                                                        'class' => 'text-right text-nowrap',
                                                    ],
                                                    //'options' => ['style' => 'width: 40px;']
                                                ],
                                                
                                                [
                                                    'label' => Yii::t('back', 'Валюта'),
                                                    'format' => 'raw',
                                                    'value' => function($model) use ($lang){
                                                        return $lang->currency;
                                                    },
                                                    'headerOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                    'contentOptions' => [
                                                        'class' => 'text-center',
                                                    ],
                                                ],
                                                
                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'controller' => 'modification',
                                                    'template' => '{delete}',
                                                    'contentOptions' => [
                                                        'class' => 'text-center'
                                                    ],
                                                    'buttons' => [
                                                        'delete' => function($url, $model){
                                                            return Html::a('', $url, [
                                                                'class' => 'glyphicon glyphicon-trash btn btn-danger btn-xs',
                                                                'title' => Yii::t('back', 'Удалить'),
                                                                'data' => [
                                                                    'pjax' => 1,
                                                                    // 'confirm' => Yii::t('back', 'Вы уверены, что хотите удалить этот элемент?'),
                                                                    // 'method' => 'post',
                                                                    // 'pjax' => '#product-modifications'
                                                                ]
                                                            ]);
                                                        },
                                                    ]
                                                ],
                                            ],
                                        ]); ?>
                                    </div>
                            <?php
                                }
                            ?>
                                </div>
                                
                            </div>
                    <?php
                        }
                    ?>
                        </div>
                <?php
                    }
                ?>
                
                <?php
                    Modal::begin([
                        'id' => 'modification-add-modal',
                        'header' => Html::tag('h4', Yii::t('back', 'Добавить опцию'), [
                            'class' => 'text-center',
                        ]),
                        'toggleButton' => [
                            'id' => 'modification-add-btn',
                            'label' => Html::tag('span', '', [
                                'class' => 'glyphicon glyphicon-plus',
                            ]) . '&nbsp;' . Yii::t('back', 'Добавить'),
                            'class' => 'btn btn-success text-right'
                        ]
                    ]);
                ?>
                    <iframe src="<?= Url::toRoute([
                        '/shop/modification/add-popup',
                        'productId' => $model->id
                    ]) ?>" id="modification-add-window"></iframe>
                <?php
                    Modal::end();
                ?>
                
            <?php Pjax::end() ?>
            
        <?php } ?>



        <?php if (!$model->isNewRecord){ ?>
            <br>
            <br>
            <br>
            <?php
                echo Html::tag('p', Yii::t('back', 'Фильтры'), [
                    'class' => 'text-bold',
                ])
            ?>
            <?php
                if ($filterPanel = \dvizh\filter\widgets\Choice::widget([
                    'model' => $model
                ])){
                    echo $filterPanel;
                } else {
                    echo Html::a(Yii::t('back', 'Фильтры'), [
                        '/filter/filter/index'
                    ], [
                        'class' => 'btn btn-info'
                    ]);
                }
            ?>
            
        <?php } ?>
        
        
        
        <div class="hidden">
        <?php 
			// echo SeoForm::widget([
                // 'model' => $model, 
                // 'form' => $form,
            // ]);
        ?>
        </div>
        
        <br>
		<br>
		<p><strong>Связанные продукты</strong></p>
        <div class="related-products-block">
            <?=\dvizh\relations\widgets\Constructor::widget(['model' => $model]);?>
        </div>


        <div class="hidden">
        <?php if(isset($priceTypes)) { ?>
            <?php if($priceTypes) { ?>
                <h3>Цены</h3>
                <?php $i = 1; foreach($priceTypes as $priceType) { ?>
                    <?= $form->field($priceModel, "[{$priceType->id}]price")->label($priceType->name); ?>
                <?php $i++; } ?>
            <?php } ?>
        <?php } ?>
        </div>
    
        <?= $form
                ->field($model, 'saveAndExit')
                ->hiddenInput(['class' => 'saveAndExit'])
                ->label(false)
        ?>

        <br>
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
		
		<br>
		<br>
        


    <?php ActiveForm::end(); ?>
    

</div>


<?php
    $this->registerJs("
        $('#product-form').on('beforeSubmit', function(event){
            event.preventDefault();
            
            // заполнение alias-ов товаров из идентификаторов
            // $('#product-slug').val($('#product-code').val());
            
        });
        ",
        View::POS_READY,
        'view-products'
    );
?>

<?php // формируем изображения заранее, до вывода на фронте 
    $productImages = [];
    foreach ($images as $image){
        $productImages[] = $image->getUrl('x200');
        $productImages[] = $image->getUrl('x1000');
        $productImages[] = $image->getUrl('x2000');
        $productImages[] = $image->getUrl('x3500');
        $productImages[] = $image->getUrl();
    }
    $this->registerJs("
        $.each(JSON.parse($productImages), function (url) {
            var img = new Image();
            img.src = url;
        });
    ", View::POS_READY);
?>
