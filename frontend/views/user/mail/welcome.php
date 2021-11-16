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
	<?= Yii::t('front', 'Добро пожаловать в мир {0}', [
			Yii::$app->name
		]) ?>!
</h1>

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
    <?= Yii::t('front', 'Благодарим тебя за регистрацию на сайте') ?> <a href="<?= Url::home(true) ?>" style="text-decoration: underline;"><?= Yii::$app->name ?></a>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	text-align: center; 
	max-width: 600px; 
	text-transform: uppercase;
">
    <?= Yii::t('front', 'Мы рады, что ты присоединился к комьюнити людей, которые думают о будущем и неравнодушны к проблемам окружающего мира.') ?>
</p>

<br>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: bold; 
	text-align: center; 
	max-width: 600px; 
">
    <?= Yii::t('front', 'Выбирая стиль {0} и приобретая нашу одежду, ты будешь:', [
			Yii::$app->name
		])
	?>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
">
    <span style="color: #EB190B !important;">●</span> <?= Yii::t('front', 'Демонстрировать свое ответственное отношение к использованию ресурсов планеты и поддерживать развитие новых технологий.') ?>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
">
    <span style="color: #EB190B !important;">●</span> <?= Yii::t('front', 'Не беспокоиться о безопасности своих детей. В нашей <a href="{0}">детской коллекции</a> есть GPS- и NFC-метки, с их помощью можно отследить локацию ребенка и связаться с ним.', [
		Url::to(['/catalog/children'], true)
	]) ?>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
">
    <span style="color: #EB190B !important;">●</span> <?= Yii::t('front', 'Носить вещи, которые обеспечивают комфорт и защиту в самых разных экстремальных условиях - на Земле и даже на Марсе. Кстати, ты в курсе, что на марсианских полюсах температура достигает -125°C?') ?>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
">
    <span style="color: #EB190B !important;">●</span> <?= Yii::t('front', 'Иметь возможность <a href="{0}">записаться в экспедицию</a> на Марс и узнать о своей готовности к ней.', [
		Url::to(['/expedition'], true)
	]) ?> <a href="<?= Url::to(['/test/mars'], true) ?>"><?= Yii::t('front', 'Пройди наш тест!') ?></a>
</p>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
">
    <span style="color: #EB190B !important;">●</span> <?= Yii::t('front', 'Участвовать в <a href="{0}">розыгрышах</a> призов от бренда.', [
		Url::to(['/scan-to-win'], true)
	]) ?>
</p>

<br>
<br>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 16px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
	text-align: center;
">
    <?= Yii::t('front', 'Посмотри на нашу <a href="{0}">новую коллекцию</a> для покорителей Красной планеты. Это просто космос!', [
		Url::to(['/catalog'], true)
	]) ?>
</p>

<br>
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

<br>
<br>

<p style="
	font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
	font-size: 14px; 
	line-height: 1.5; 
	font-weight: light; 
	max-width: 600px; 
	text-align:center; 
">
    <?php
		if ($showPassword || $module->enableGeneratingPassword){
	?>
			<?= Yii::t('front', 'Автоматически сгенерированный пароль для Вашей учётной записи') ?>: 
			<br>
			<strong><?= $user->password ?></strong>
    <?php
		}
	?>
</p>

<?php 
	if ($token !== null){
?>
		<p style="
			font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
			font-size: 14px; 
			line-height: 1.5; 
			font-weight: light; 
			max-width: 600px; 
			text-align: center; 
		">
			<?= Yii::t('front', 'Чтобы завершить регистрацию, пожалуйста, пройдите по ссылке ниже') ?>:
		</p>
		<p style="
			font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
			font-size: 14px; 
			line-height: 1.5; 
			font-weight: light; 
			max-width: 600px; 
			text-align: center; 
		">
			<?= Html::a(Html::encode($token->url), $token->url); ?>
		</p>
		<p style="
			font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
			font-size: 14px; 
			line-height: 1.5; 
			font-weight: light; 
			max-width: 600px; 
			text-align: center; 
		">
			<?= Yii::t('front', 'Если у Вас не получается перейти по ссылке, скопируйте её в адресную строку браузера') ?>.
		</p>
<?php
	}
?>
