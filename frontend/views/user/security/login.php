<?php

    use dektrium\user\widgets\Connect;
    use dektrium\user\models\LoginForm;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;

    /**
     * @var yii\web\View $this
     * @var dektrium\user\models\LoginForm $model
     * @var dektrium\user\Module $module
     */

    $this->title = Yii::t('front', 'Авторизация');
    $this->params['breadcrumbs'][] = $this->title;
    
?>

<div class="container mt-15">
    
    <div class="row justify-content-center">
    
        <div class="col-xs-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-5">

            <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    // 'action' => '/login',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]); 
            ?>
        
                <?= $form
                        ->field($model, 'login', [
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->textInput([
                            'autofocus' => 'autofocus',
                            'class' => 'form-control mb-0 px-0',
                            'autocomplete' => rand(),
                            'tabindex' => '1',
                            'required' => true,
                            'placeholder' => ' ',
                        ])
                        ->label(Yii::t('front', 'E-mail'));
                ?>

                <?= $form
                        ->field($model, 'password', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'tabindex' => '2',
                                'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}'
                        ])
                        ->passwordInput()
                        ->label(Yii::t('front', 'Пароль'))
                ?>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="mb-1_5">
                            <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Вход'),
                                [
                                    'class' => 'btn btn-primary btn-block text-uppercase py-1',
                                    'tabindex' => '4',
                                    'title' => Yii::t('front', 'Вход')
                                ]
                            ) ?>
                        </div>
                        <div class="mb-2">
                            <?= Html::a(Yii::t('front', 'Регистрация'), ['/register'], [
                                    'class' => 'btn btn-outline-primary btn-block text-uppercase py-1',
                                ])
                            ?>
                        </div>
                        <div class="mb-2">
                            <?= Html::a(Yii::t('front', 'Забыли пароль?'), ['/request'])?>
                        </div>
                    </div>
                </div>
                
                <?= Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth'],
                ]) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    
</div>
