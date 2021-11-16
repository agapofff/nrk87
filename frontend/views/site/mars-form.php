<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
    use yii\web\View;
    
    $title = Yii::t('front', 'Возможно, твое предназначение находится на другой планете.');

    $this->title = strip_tags(Yii::$app->params['title'] ?: $title) . ' - ' . Yii::$app->name;
    $h1 = Yii::$app->params['h1'] ?: $title;
    
    $this->registerCss('
        body {
            background-image: url("/images/mars_big_2.png");
            background-position: center 200px;
            background-repeat: no-repeat;
            background-size: 80%;
        }
    ');

?>


<?php 
    Pjax::begin([
        'enablePushState' => false,
    ]);
?>

<div class="container-fluid">

    <div class="row justify-content-center my-5">
    
        <div class="col-12 col-lg-11">
            <h1 class="w-100 text-center acline display-2 mb-5">
                <?= $title ?>
            </h1>
            <p class="lead my-5 text-center">
                <?= Yii::t('front', 'Отправь заявку, и мы включим тебя в список кандидатов нашей миссии на Марс.') ?>
            </p>
        </div>
        
        <div class="col-12 col-sm-10 col-md-7 col-lg-6 col-xl-5">
            <p>
                <?= Yii::t('front', 'NRK87. собирает экспедицию из самых ярких представителей человечества для покорения Красной планеты.') ?>
            </p>
            <p>
                <?= Yii::t('front', 'Мы приглашаем тех, кто привык мыслить в космических масштабах и стремится открывать новые миры и возможности.') ?>
            </p>
            <p>
                <?= Yii::t('front', 'Чтобы стать частью команды, решающей задачи завтрашнего дня, оформи заявку и присоединяйся к нам.') ?>
            </p>
            <p>
                <?= Yii::t('front', 'Отсюда начинается новая эра человечества.') ?>
            </p>
        </div>
        
    </div>
    
    <div class="row justify-content-center my-5">
    
<?php
    if ($sent){
?>

        <div class="col-12 text-center">
        
            <p class="lead">
                <?= Yii::t('front', 'Ваша заявка на участие в экспедиции на Марс была успешно отправлена') ?>
            </p>
        
			<?= Html::a(Html::tag('span') . Yii::t('front', 'Вернуться на Главную'), '/' . Yii::$app->language, [
					'class' => 'btn btn-nrk my-2',
					'title' => Yii::t('front', 'Вернуться на Главную'),
					'data-pjax' => 0
				])
			?>
        
        </div>
    
<?php
    } else {
?>

        <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6">
        
            <?php
                $form = ActiveForm::begin([
                    'options' => [
                        'data-pjax' => true,
                    ],
                ]);
            ?>
        
                <?= $form
                        ->field($model, 'name', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
            
                <div class="form-group mb-5 pt-2">
                    <label class="control-label float-left mr-4">
                        <?= Yii::t('front', 'Пол') ?>
                    </label>
                    <?= $form
                            ->field($model, 'gender')
                            ->radioList(
                                [
                                    1 => Yii::t('front', 'Мужской'),
                                    0 => Yii::t('front', 'Женский'),
                                ],
                                [
                                    'item' => function($index, $label, $name, $checked, $value) use ($model){
                                        return '
                                            <div class="custom-control custom-radio d-inline mr-4">
                                                <input type="radio" name="' . $name . '" class="custom-control-input" ' . ($value == $model->gender ? 'checked' : '') . ' id="' . $name . $value . '" value="' . $value . '">
                                                <label class="custom-control-label" for="' . $name . $value . '">' . $label . '</label>
                                            </div>';
                                    }
                                ]
                            )
                            ->label(false)
                    ?>
                </div>
                
                <?= $form
                        ->field($model, 'country', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'language', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'age', [
                            'inputOptions' => [
                                'type' => 'number',
                                'min' => 18,
                                'max' => 130,
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>

                <div class="form-group text-center my-5">
                    <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Отправить заявку'), [
                            'class' => 'btn-nrk',
                            'title' => Yii::t('front', 'Отправить заявку'),
                        ])
                    ?>
                </div>
            
    
            <?php ActiveForm::end(); ?>
        
        </div>
    
<?php
    }
?>

    </div>
    
</div>

<?php
    Pjax::end();
?>