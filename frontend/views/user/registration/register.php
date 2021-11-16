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
<div class="container my-4 my-lg-5">

    <h1 class="text-center acline font-weight-light my-4 my-lg-5 py-4 py-lg-5">
        <?= $this->title ?>
    </h1>

    <div class="row justify-content-center align-items-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-6">

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
                                    'class' => 'form-control form-control-lg mb-0 px-0',
                                    'tabindex' => '2',
                                    'required' => true,
                                    'autocomplete' => rand(),
                                    'placeholder' => ' ',
                                ],
                                'options' => [
                                    'class' => 'form-group mb-3 position-relative floating-label',
                                ],
                                'template' => '{input}{label}{error}'
                            ]
                        )
                ?>

                <?= $form
                        ->field($model, 'username', [
                            'template' => '{input}',
                        ])
                        ->hiddenInput()
                        ->label(false)
                ?>
                
                <div class="form-group mb-5">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="agree" name="agree" checked>
                        <label class="custom-control-label" for="agree">
                            <?= Yii::t('front', 'Даю согласие на обработку моих персональных данных.') ?> <?= Html::a(Yii::t('front', 'Подробнее'), [
                                    '/policy'
                                ], [
                                    'target' => '_blank',
                                ]) ?>...
                        </label>
                    </div>
                </div>

                <?php
                    if ($module->enableGeneratingPassword == false){
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

                <div class="text-center my-5">
                    <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Зарегистрироваться'),
                            [
                                'class' => 'btn-nrk',
                                'tabindex' => '4',
                                'title' => Yii::t('front', 'Зарегистрироваться'),
                            ]
                        )
                    ?>
                </div>

            <?php ActiveForm::end(); ?>

            <div class="row justify-content-center">
                <div class="col-auto text-center">
                    <p><?= Html::a(Yii::t('front', 'Авторизация'), ['/login']) ?></p>
                </div>
            <?php if ($module->enablePasswordRecovery){ ?>
                <div class="col-auto text-center">
                    <p><?= Html::a(Yii::t('front', 'Забыли пароль?'), ['/request']) ?></p>
                </div>
            <?php } ?>
            <?php if ($module->enableConfirmation){ ?>
                <div class="col-auto text-center">
                    <p><?= Html::a(Yii::t('front', 'Не получили письмо с подтверждением регистрации?'), ['/resend']) ?></p>
                </div>
            <?php } ?>
            </div>
            
        </div>

    </div>
    
</div>

<?php
    $this->registerJS("
        $('#registration-form').on('beforeValidateAttribute', function(event, attr, msg){
            $('#register-form-username').val($('#register-form-email').val());
        });
    ",
    View::POS_READY,
    'autofill-username-by-email');
?>

<?php
    $this->registerJs("
            $('form :checkbox').change(function(){
                if (this.checked){
                    $(this)
                        .parents('form')
                        .removeAttr('disabled')
                        .removeClass('disabled')
                        .find('button[type=\'submit\']')
                        .removeAttr('disabled')
                        .removeClass('disabled');
                } else {
                    $(this)
                        .parents('form')
                        .attr('disabled', 'disabled')
                        .addClass('disabled')
                        .find('button[type=\'submit\']')
                        .attr('disabled', 'disabled')
                        .addClass('disabled');
                }
            });
        ",
        View::POS_READY,
        'agree');
?>