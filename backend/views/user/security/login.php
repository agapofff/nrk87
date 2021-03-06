<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\alert\AlertBlock;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <br>
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
        <br>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]) ?>

        <?php if ($module->debug): ?>
            <?= $form->field($model, 'login', [
                'inputOptions' => [
                    'autofocus' => 'autofocus',
                    'class' => 'form-control',
                    'tabindex' => '1']])->dropDownList(LoginForm::loginList());
            ?>

        <?php else: ?>

            <?= $form->field($model, 'login',
                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
            );
            ?>

        <?php endif ?>

        <?php if ($module->debug): ?>
            <div class="alert alert-warning">
                <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
            </div>
        <?php else: ?>
            <?= $form->field(
                $model,
                'password',
                ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                ->passwordInput()
                ->label(
                    Yii::t('user', 'Password')
                    . ($module->enablePasswordRecovery ?
                        ' (' . Html::a(
                            Yii::t('user', 'Forgot password?'),
                            ['/user/recovery/request'],
                            ['tabindex' => '5']
                        )
                        . ')' : '')
                ) ?>
        <?php endif ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3', 'checked' => true]) ?>
        <div class="text-center">
            <?= Html::submitButton(
                Yii::t('user', 'Sign in'),
                ['class' => 'btn btn-primary btn-lg', 'tabindex' => '4']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>


        <br>
        <?php if ($module->enableConfirmation): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
            </p>
        <?php endif ?>
        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
        ]) ?>
    </div>
</div>
