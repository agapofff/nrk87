<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('front', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-15">

    <div class="row justify-content-center align-items-center">

        <div class="col-xs-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-5">

            <?php
                $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    // 'action' => '/register',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]);
            ?>

                <?= $form
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control mb-0 px-0',
                                'tabindex' => '2',
                                'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-1 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{error}'
                        ]
                    )
                ?>

                <?= $form
                        ->field($model, 'username', [
                            'template' => '{input}',
                            'options' => [
                                'class' => 'd-none',
                            ],
                        ])
                        ->hiddenInput()
                        ->label(false)
                ?>
                
                <div class="form-group mt-2 mb-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="agree" name="agree" checked>
                        <label class="custom-control-label" for="agree">
                            <?= Yii::t('front', 'Даю согласие на обработку моих персональных данных.') ?> <?= Html::a(Yii::t('front', 'Подробнее'), [
                                    '/privacy-policy'
                                ], [
                                    'target' => '_blank',
                                ]) ?>...
                        </label>
                    </div>
                </div>

                <?php
                    if ($module->enableGeneratingPassword == false) {
                ?>
                    <?= $form
                            ->field(
                                $model,
                                'password'
                            )
                            ->passwordInput()
                ?>
                <?php } ?>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>

                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="mb-2 mt-5">
                            <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Зарегистрироваться'),
                                [
                                    'class' => 'btn btn-primary btn-block text-uppercase py-1',
                                    'tabindex' => '4',
                                    'title' => Yii::t('front', 'Зарегистрироваться')
                                ]
                            ) ?>
                        </div>
                        <div class="mb-2 mt-3">
                            <?= Yii::t('front', 'Уже есть аккаунт?') ?> <?= Html::a(Yii::t('front', 'Войти'), ['/login']) ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-2">
                            <?= Html::a(Yii::t('front', 'Не получили письмо с подтверждением регистрации?'), [
                                    '/resend'
                                ])
                            ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
            
        </div>

    </div>
    
</div>

<?php
    $this->registerJS("
        $('#registration-form')
            .on('beforeValidateAttribute', function (event, attr, msg) {
                $('#register-form-username').val($('#register-form-email').val());
            })
            .on('beforeSubmit', function (event) {
                event.preventDefault();
                if (!$('#agree').checked) {
                    toastr.error('" . Yii::t('front', 'Необходимо согласиться') . "');
                    return false;
                }
            })
    ",
    View::POS_READY);
?>
