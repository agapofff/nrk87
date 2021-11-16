<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
    use yii\web\View;

	/**
	 * @var yii\web\View $this
	 * @var yii\widgets\ActiveForm $form
	 * @var dektrium\user\models\User $user
	 * @var dektrium\user\models\SettingsForm $model
	 */

	$this->title = Yii::t('front', 'Личный кабинет');
	// $this->params['breadcrumbs'][] = $this->title;
    
    $this->registerCSS("
        body {
            background: radial-gradient(180.55% 81.29% at 50% 100%, #3C0805 0%, #000000 100%);
        }
    ");
?>

<div class="container">

    <h1 class="acline font-weight-light my-5 display-2">
        <?= $this->title ?>
    </h1>
    
    <h2 class="acline font-weight-light h1 my-5">
        <?= Yii::t('front', 'Персональные данные') ?>
    </h2>
    
    <?php
        $form = ActiveForm::begin([
            'id' => 'account-form',
            // 'action' => '/account',
            // 'method' => 'get',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]);
    ?>

        <div class="row justify-content-start my-5 py-4">
        
            <div class="col-12 col-md-6 col-lg-4">
                
				<?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                // 'autofocus' => 'autofocus',
                                'class' => 'form-control mb-0 px-0',
                                'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->first_name,
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Имя'))
                ?>
                
                <?= $form
                        ->field($model, 'last_name', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->last_name,
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Фамилия'))
                ?>
                
                <?= $form
                        ->field($model, 'birthday', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'placeholder' => ' ',
                                'value' => $profile->birthday,
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->textInput([
                            'type' => 'date',
                            'placeholder' => ' ',
                        ])
                        ->label(Yii::t('front', 'Дата рождения'))
                ?>
                
                <div class="form-group mb-5 pt-2">
                    <label class="control-label float-left mr-4">
                        <?= Yii::t('front', 'Пол') ?>
                    </label>
                    <?= $form
                            ->field($model, 'sex')
                            ->radioList(
                                [
                                    1 => Yii::t('front', 'Мужской'),
                                    0 => Yii::t('front', 'Женский'),
                                ],
                                [
                                    'item' => function($index, $label, $name, $checked, $value) use ($profile){
                                        return '
                                            <div class="custom-control custom-radio d-inline mr-4">
                                                <input type="radio" name="' . $name . '" class="custom-control-input" ' . ($value == $profile->sex ? 'checked': '') . ' id="' . $name . $value . '" value="' . $value . '">
                                                <label class="custom-control-label" for="' . $name . $value . '">' . $label . '</label>
                                            </div>';
                                    }
                                ]
                            )
                            ->label(false)
                    ?>
                </div>
                
            </div>
            
            <div class="col-12 col-md-6 col-lg-4">
            
                <?= $form
                        ->field($model, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->phone,
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
                                // 'value' => $profile->email,
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>

				<?= $form
                        ->field($model, 'new_password', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                // 'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->passwordInput()
                        // ->hint(Yii::t('front', 'Не менее 6 латинских букв, цифр и спец. символов'))
                ?>
                
				<?= $form
                        ->field($model, 'current_password', [
                            'inputOptions' => [
                                // 'autofocus' => 'autofocus',
                                'class' => 'form-control mb-0 px-0',
                                // 'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->passwordInput()
                        // ->hint(Yii::t('front', 'Введите текущий пароль для Вашей учётной записи'))
                ?>
                
            </div>
            
            <div class="col-12 col-lg-4">
            
                <?= $form
                        ->field($model, 'comment', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0 px-2',
                                'autocomplete' => rand(),
                                // 'placeholder' => ' ',
                                'value' => $profile->comment,
                                'rows' => 7,
                                'style' => '
                                    resize: none;
                                    height: 260px;
                                    margin-top: 4px;
                                ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative',
                            ],
                            'template' => '{label}{input}{hint}{error}',
                        ])
                        ->textArea()
                ?>
            
            </div>
            
            <div class="col-12 col-md-6 col-lg-4">
            
                <?= $form
                        ->field($model, 'agree', [
                            'options' => [
                                'class' => 'form-group mb-5',
                            ],
                            'inputOptions' => [
                                'class' => 'custom-control-input',
                                'checked' => ($profile->agree ? 'checked' : false),
                            ],
                            'labelOptions' => [
                                'class' => 'custom-control-label',
                            ],
                            'template' => '<div class="custom-control custom-checkbox">{input}{label}</div>',
                        ])
                        ->textInput([
                            'type' => 'checkbox',
                        ])
                ?>
            
            </div>
            
            <div class="col-12 col-md-6 col-lg-4">
            
                <?= $form
                        ->field($model, 'lottery', [
                            'options' => [
                                'class' => 'form-group mb-5',
                            ],
                            'inputOptions' => [
                                'class' => 'custom-control-input',
                                'checked' => ($profile->lottery ? 'checked' : false),
                            ],
                            'labelOptions' => [
                                'class' => 'custom-control-label',
                            ],
                            'template' => '<div class="custom-control custom-checkbox">{input}{label}</div>',
                        ])
                        ->textInput([
                            'type' => 'checkbox',
                        ])
                ?>
            
            </div>
            
            <div class="col-12 col-sm-6 col-md-12 col-lg-4">

				<div class="form-group text-center text-lg-left">
					<?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Сохранить'), [
                            'class' => 'btn-nrk',
                            'title' => Yii::t('front', 'Сохранить'),
                        ])
                    ?>
				</div>
            
            </div>
        
        </div>
        
        <?= Html::hiddenInput('lang', Yii::$app->language) ?>

    <?php ActiveForm::end(); ?>
	
<?php if ($model->module->enableAccountDelete){ ?>
	<hr/>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
			<h3 class="text-center"><?= Yii::t('user', 'Delete account') ?></h3>
			<p><?= Yii::t('user', 'Внимание! Удаление аккаунта - необратимая операция') ?>!</p>
			<p><?= Yii::t('user', 'Будут удалены все данные, связанные с Вашей учётной записью') ?>.</p>
			<?= Html::a(Yii::t('user', 'Удалить аккаунт'), ['delete'], [
				'class' => 'btn btn-danger',
				'data-method' => 'post',
				'data-confirm' => Yii::t('user', 'Вы уверены, что хотите удалить Вашу учётную запись без возможности восстановления?'),
			]) ?>
		</div>
    </div>
<?php } ?>


<?php
    $this->registerJs("
        $('body').on('input', '#settings-form-new_password', function(){
            $('#settings-form-current_password')
                .attr('required', 'required')
                .attr('aria-required', 'true');
        });
    ",
    View::POS_READY,
    'new-password-require');
?>
