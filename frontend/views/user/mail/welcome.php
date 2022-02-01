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

/**
 * @var dektrium\user\Module $module
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Token $token
 * @var bool $showPassword
 */
?>

<h1 style="text-align: center;">
    <?= Yii::t('front', 'Благодарим Вас за регистрацию на сайте {0}', [
            Yii::$app->name
        ])
    ?>
</h1>

<br>

<p>
    <?php
        if ($showPassword || $module->enableGeneratingPassword) {
    ?>
            <?= Yii::t('front', 'Автоматически сгенерированный пароль для Вашей учётной записи') ?>: 
            <br>
            <strong><?= $user->password ?></strong>
    <?php
        }
    ?>
</p>

<?php 
    if ($token !== null) {
?>
        <p>
            <?= Yii::t('front', 'Чтобы завершить регистрацию, пожалуйста, пройдите по ссылке ниже') ?>:
        </p>
        <p>
            <?= Html::a(Html::encode($token->url), $token->url); ?>
        </p>
        <p>
            <?= Yii::t('front', 'Если у Вас не получается перейти по ссылке, скопируйте её в адресную строку браузера') ?>.
        </p>
<?php
    }
?>
