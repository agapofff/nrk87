<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('front', 'Новый пароль');
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
				'id' => 'password-recovery-form',
                // 'action' => str_replace('/' . Yii::$app->language, '', Url::to()),
				'enableAjaxValidation' => true,
				'enableClientValidation' => false,
			]);
		?>

			<?= $form
                    ->field($model, 'password', [
                        'inputOptions' => [
                            'autofocus' => 'autofocus',
                            'class' => 'form-control form-control-lg mb-0 px-0',
                            'tabindex' => '2',
                            'required' => true,
                        ],
                        'options' => [
                            'class' => 'form-group mb-5 position-relative floating-label',
                        ],
                        'template' => '{input}{label}{error}'
                    ]
                )
                ->passwordInput()
                ->label(Yii::t('front', 'Новый пароль'));
            ?>
            
            <?= Html::hiddenInput('lang', Yii::$app->language) ?>

			<div class="form-group text-center my-5">
                <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Сохранить'), [
                        'class' => 'btn-nrk',
                        'title' => Yii::t('front', 'Сохранить'),
                    ])
                ?>
            </div>

			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>