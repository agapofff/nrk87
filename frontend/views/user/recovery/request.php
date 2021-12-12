<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;

    $this->title = Yii::t('front', 'Восстановить пароль');
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">

	<div class="row justify-content-center">
		
		<div class="col-xs-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-5">
		
			<?php 
				$form = ActiveForm::begin([
					'id' => 'password-recovery-form',
                    // 'action' => '/request',
					'enableAjaxValidation' => true,
					'enableClientValidation' => false,
				]);
			?>

				<?= $form
                        ->field($model, 'email', [
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{error}'
                        ])
                        ->input('email')
                        ->textInput([
                            'autofocus' => 'autofocus',
                            'class' => 'form-control form-control-lg mb-0 px-0',
                            'tabindex' => '1',
                            'required' => true,
                        ])
                        ->label(Yii::t('front', 'E-mail'))
                ?>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>

				<div class="row no-gutters">
					<div class="col-md-6">
						<?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Продолжить'),
							[
								'class' => 'btn btn-primary btn-block text-uppercase py-1',
								'tabindex' => '4',
								'title' => Yii::t('front', 'Продолжить')
							]
						) ?>
					</div>
				</div>

			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>