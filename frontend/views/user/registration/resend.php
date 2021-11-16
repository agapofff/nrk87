<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
    use yii\web\View;

	/**
	 * @var yii\web\View $this
	 * @var dektrium\user\models\ResendForm $model
	 */

	$this->title = Yii::t('front', 'Подтверждение учётной записи');
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-4 my-lg-5">
    
    <h1 class="text-center acline font-weight-light my-4 my-lg-5 py-4 py-lg-5">
        <?= $this->title ?>
    </h1>
    
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
		
        <?php
			$form = ActiveForm::begin([
				'id' => 'resend-form',
                // 'action' => '/resend',
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

				<div class="form-group text-center my-5">
					<?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Продолжить'), [
                            'class' => 'btn-nrk',
                            'title' => Yii::t('front', 'Продолжить'),
                        ])
                    ?>
				</div>

        <?php
			ActiveForm::end();
        ?>
        
		</div>
	</div>
</div>