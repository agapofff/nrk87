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

<div class="container mt-15">

    <div class="row justify-content-center">
    
        <div class="col-xs-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-5">
        
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

                <div class="row no-gutters">
                    <div class="col-md-6">
                        <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Сохранить'),
                            [
                                'class' => 'btn btn-primary btn-hover-warning btn-block text-uppercase py-1',
                                'tabindex' => '4',
                                'title' => Yii::t('front', 'Сохранить')
                            ]
                        ) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>