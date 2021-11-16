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

<div class="container my-4 my-lg-5">
    
    <h1 class="text-center font-weight-light acline my-4 my-lg-5 py-4 py-lg-5">
        <?= $this->title ?>
    </h1>
    
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">

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
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->textInput([
                            'autofocus' => 'autofocus',
                            'class' => 'form-control form-control-lg mb-0 px-0',
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
                                'class' => 'form-control form-control-lg mb-0 px-0',
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

				<div class="form-group text-center my-5">
					<?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Вход'),
						[
                            'class' => 'btn-nrk',
                            'tabindex' => '4',
                            'title' => Yii::t('front', 'Вход')
                        ]
					) ?>
				</div>
				
				<?= Connect::widget([
					'baseAuthUrl' => ['/user/security/auth'],
				]) ?>

            <?php ActiveForm::end(); ?>
            
            <div class="row justify-content-center">
                <div class="col-auto text-center">
                    <p><?= Html::a(Yii::t('front', 'Регистрация'), ['/register']) ?></p>
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
