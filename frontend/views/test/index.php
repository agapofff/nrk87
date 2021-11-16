<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
    use yii\web\View;
    
    $this->title = $meta ? $meta->title : json_decode($test->name)->{Yii::$app->language};
    $heading = $meta ? $meta->h1 : $this->title;
    if ($meta){
        $this->registerMetaTag([
            'name' => 'description',
            'content' => $meta->description
        ]);
    }
    
    $this->registerCSS("
        body {
            background: radial-gradient(180.55% 81.29% at 50% 100%, #3C0805 0%, #000000 100%);
        }
    ");
?>

<?= Html::img('/images/mars.png', [
        'style' => '
            position: fixed;
            bottom: 0;
            left: 0;
            display: block;
            width: 40vw;
            min-width: 250px;
            z-index: 0;
            pointer-events: none;
        ',
    ])
?>

<?php 
    Pjax::begin([
        'enablePushState' => false,
    ]);
?>

<div class="container-fluid my-4 my-lg-5">

    <div class="row justify-content-center my-4 my-lg-5">
    
        <div class="col-12 col-lg-11">

            <div class="row justify-content-between position-relative">
            
            <?php
                if ($finish){
            ?>
                
                    <div class="col-12 col-md-10 col-lg-8 col-xl-6" style="position: absolute; z-index: 1">
                            <h1 class="display-3 acline my-5">
                                <small class="acline"><?= Yii::t('front', 'Твой результат') ?>:</small> <?= $right ?><small class="acline"> / <?= $total ?>
                            </h1>
                        <h2 class="display-2 acline my-5">
                            <?= json_decode($testResult->name)->{Yii::$app->language} ?>
                        </h2>
                        
                        <div class="test-result-description">
                            <?= json_decode($testResult->description)->{Yii::$app->language} ?>
                        </div>
                        
                        <div class="row justify-content-between my-5">
                            <div class="col-auto">
                                <?= Html::a(Html::tag('span') . Yii::t('front', 'Вернуться на Главную'), Url::home(true),[
                                        'class' => 'btn btn-nrk my-2',
                                        'title' => Yii::t('front', 'Вернуться на Главную'),
                                        'data-pjax' => 0
                                    ])
                                ?>
                            </div>
                            <div class="col-auto">
                                <?= Html::a(Html::tag('span') . Yii::t('front', 'Пройти тест ещё раз'), [
                                        'test/' . $slug . '/reset'
                                    ],[
                                        'class' => 'btn btn-nrk my-2',
                                        'title' => Yii::t('front', 'Пройти тест ещё раз'),
                                    ])
                                ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    <?= Html::tag('div', '', [
                            'class' => 'fixed-bottom d-flex vw-100 vh-75 justify-content-center pointer-events-none',
                            'style' => '
                                min-width: 500px;
                                background: url("/images/biologist1.png") right bottom/contain no-repeat;
                                z-index: 0;
                            ',
                        ])
                    ?>
                    
            <?php
                } else {
            ?>
            
                <?php
                    if ($start){
                ?>
                
                    <div id="start">
                        <div class="col-12 col-md-10 col-lg-8 col-xl-6 start collapse show" style="position: absolute; z-index: 1">
                            <h2 class="display-2 acline my-5">
                                <?= json_decode($test->name)->{Yii::$app->language} ?>
                            </h2>
                            
                            <div class="test-result-description">
                                <?= json_decode($test->description)->{Yii::$app->language} ?>
                            </div>
                            
                            <div class="text-center">
                                <?= Html::button(Html::tag('span') . Yii::t('front', 'Начать тест'), [
                                        'class' => 'btn btn-nrk my-5',
                                        'title' => Yii::t('front', 'Начать тест'),
                                        'onclick' => "
                                            $('#start').hide();
                                            $('.test').show();
                                        ",
                                    ])
                                ?>
                            </div>
                            
                        </div>
                        
                        <?= Html::tag('div', '', [
                                'class' => 'fixed-bottom d-flex vw-100 vh-75 justify-content-center pointer-events-none',
                                'style' => '
                                    min-width: 500px;
                                    background: url("/images/biologist1.png") right bottom/contain no-repeat;
                                    z-index: 0;
                                ',
                            ])
                        ?>
                        
                    </div>
                    
                <?php
                    }
                ?>
            
                    <div class="col-12 col-md-6 col-xl-5 test" <?php if ($start){?>style="display:none"<?php } ?>>
                        
                        <p>
                            <?= Yii::t('front', 'Вопрос') ?> <?= $questionNumber ?>
                        </p>
                    <?php
                        if ($answered){
                    ?>
                            <h2 class="display-2 acline my-5">
                                <?= Yii::t('front', $correct ? 'Правильно' : 'Неправильно') ?>!
                            </h2>
                            
                            <h3 class="display-4">
                                <?= json_decode($correct ? $question->text_right : $question->text_wrong)->{Yii::$app->language} ?>
                            </h3>
                            
                            <div class="form-group mt-5 text-right">
                                <?= Html::a(Html::tag('span') . Yii::t('front', 'Дальше'), [
                                        'test/' . $slug
                                    ],[
                                        'class' => 'btn btn-nrk',
                                        'title' => Yii::t('front', 'Дальше'),
                                    ])
                                ?>
                            </div>
                    <?php
                        } else {
                    ?>
                        <h1 class="display-3">
                            <?= json_decode($question->name)->{Yii::$app->language} ?>
                        </h1>
                    <?php
                        }
                    ?>
                    
                    </div>
                    
                    <div class="col-12 col-md-6 col-xl-4 test" <?php if ($start){?>style="display:none"<?php } ?>>
                    
                    <?php
                        if ($answered){
                    ?>
                    
                        <?= Html::beginTag('div', [
                                'style' => '
                                    width: 100%;
                                    height: 70vh;
                                    overflow-y: scroll;
                                ',
                            ]);
                        ?>
                        
                            <h4 class="display-4 my-5">
                                <?= json_decode($rightAnswer->name)->{Yii::$app->language} ?>
                            </h4>
                            
                            <div class="question-description pr-2">
                                <?= json_decode($question->description)->{Yii::$app->language} ?>
                                
                                <?php
                                    if ($questionImage){
                                        echo Html::img($questionImage, [
                                            'class' => 'img-fluid my-4',
                                        ]);
                                    }
                                ?>
                            </div>
                        
                        <?= Html::endTag('div'); ?>
                    
                    <?php
                        } else {
                    ?>
                    
                        <?php
                            $form = ActiveForm::begin([
                                // 'id' => 'test-form',
                                // 'action' => '/test/' . $slug,
                                // 'method' => 'get',
                                'options' => [
                                    // 'class' => 'ajax',
                                    'data-pjax' => true,
                                ],
                            ]);
                        ?>
                        
                            <div class="form-group my-5">
                            
                                <?= $form
                                        ->field($model, 'answer_id')
                                        ->radioList(ArrayHelper::map($answers, 'id', function($answer){
                                                return json_decode($answer->name)->{Yii::$app->language};
                                            }),
                                            [
                                                'item' => function($index, $label, $name, $checked, $value) use ($questionNumber){
                                                    return '
                                                        <div class="custom-control custom-radio d-block w-100 mb-4">
                                                            <input type="radio" name="' . $name . '" class="custom-control-input" id="question-' . $questionNumber . '-' . $value . '" value="' . $value . '">
                                                            <label class="custom-control-label" for="question-' . $questionNumber . '-' . $value . '">' . $label . '</label>
                                                        </div>';
                                                }
                                            ]
                                        )
                                        ->label(false)
                                ?>
                            
                            </div>

                            <div class="form-group mt-5">
                                <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Ответить'), [
                                        'class' => 'btn-nrk',
                                        'title' => Yii::t('front', 'Ответить'),
                                    ])
                                ?>
                            </div>
                            
                            <?= $form
                                    ->field($model, 'test_id')
                                    ->hiddenInput()
                                    ->label(false)
                            ?>
                            
                            <?= $form
                                    ->field($model, 'question_id')
                                    ->hiddenInput()
                                    ->label(false)
                            ?>
                            
                            <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                        
                        <?php ActiveForm::end(); ?>
                        
                    <?php
                        }
                    ?>
                    
                    </div>
            <?php
                }
            ?>
                
            </div>
          
        </div>
        
    </div>
    
</div>

<?php
    Pjax::end();
?>