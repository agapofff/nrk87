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

<h1 style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 22px; 
	line-height: 1.7; 
	font-weight: light;
	width: 100%; 
	max-width: 600px; 
	text-align: center; 
	text-transform: uppercase;
">
	<?= Yii::t('front', 'Дорогой друг, ты совершил очень ответственный шаг!') ?>
</h1>

<br>
<br>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light;
	text-align: center; 
	max-width: 600px; 
	text-transform: uppercase;
">
    <?= Yii::t('front', 'Твоё имя внесено в список кандидатов, желающих принять участие в экспедиции на Марс. Именно ты можешь стать одним из основателей новой цивилизации!') ?>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 18px; 
	line-height: 1.5; 
	font-weight: light;
	text-align: center; 
	max-width: 600px; 
	text-transform: uppercase;
">
    <?= Yii::t('front', 'Твой №') ?>: <strong><?= $model->id ?></strong>.
</p>

<br>

<!--
<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: normal; 
	margin: 0 0 20px; 
	padding: 0; 
	max-width: 600px; 
">
    <?= Yii::t('front', 'Подробности о программе путешествия') ?> <a href="<?= Url::to(['', true]) ?>" style="text-decoration: underline;"><?= Yii::t('front', 'здесь') ?></a>
</p>
-->

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light;
	max-width: 600px; 
">
	<?= Yii::t('front', 'Подготовиться к предстоящему полёту и жизни на Марсе можно с новой коллекцией') ?> <a href="<?= Url::to(['/catalog/adults', true]) ?>" style="text-decoration: underline;"><?= Yii::$app->name ?></a>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light;
	max-width: 600px; 
">
	<?= Yii::t('front', 'Кстати, марсианская сила притяжения составляет 38% от земной, и к ней необходимо адаптироваться заблаговременно. Поэтому, для более легкого и удобного доступа к карманам, в нашей одежде мы используем магниты, а не тяжелые молнии и липучки.') ?>
</p>

<br>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 22px; 
	line-height: 1.5; 
	font-weight: light;
	text-align: center; 
	max-width: 600px; 
	color: #EB190B !important;
	text-transform: uppercase;
">
	<?= Yii::t('front', 'Мы любим тебя до Марса и обратно') ?> :)
</p>