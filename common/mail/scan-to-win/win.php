<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

	<h1 style="
		font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
		font-size: 48px; 
		line-height: 1.5; 
		font-weight: 300; 
		width: 100%; 
		max-width: 600px; 
		text-align: center; 
		padding: 0; 
	">
        <?= Yii::t('front', 'Поздравляем') ?>!
    </h1>

	<h2 style="
		font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
		font-size: 35px; 
		line-height: 1.5; 
		font-weight: 300; 
		width: 100%; 
		max-width: 600px; 
		text-align: center; 
		padding: 0; 
	">
        <?= Yii::t('front', 'Ваш код победил в розыгрыше') ?> <?= Yii::$app->name ?>
    </h2>

	<p style="
		font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
		font-size: 18px; 
		line-height: 1.5; 
		font-weight: normal; 
		margin: 0 0 20px; 
		padding: 0; 
		text-align: center; 
		max-width: 600px; 
	">
        <?= Yii::t('front', 'Выигрышный код') ?>:
    </p>

	<h3 style="
		font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
		font-size: 25px; 
		line-height: 1.5; 
		font-weight: 300; 
		width: 100%; 
		max-width: 600px; 
		text-align: center; 
		padding: 0; 
	">
		<?= $code ?>
	</h3>

    <hr>

	<h3 style="
		font-family: 'Montserrat', Helvetica, Arial, sans-serif; 
		font-size: 25px; 
		line-height: 1.5; 
		font-weight: 300; 
		width: 100%; 
		max-width: 600px; 
		text-align: center; 
		padding: 0; 
	">
        <?= Yii::t('front', 'Текущий розыгрыш') ?>: <strong><?= $date_start ?></strong> — <strong><?= $date_end ?></strong>
    </h3>

    <table>
        <tr>
            <td>
                <a href="<?= $product_link ?>">
                    <img src="<?= $product_image ?>" style="
                        margin-right: 10px;
                        margin-bottom: 10px;
                    ">
                </a>
            </td>
            <td>
                <p>
                    <a href="<?= $product_link ?>">
                        <strong><?= $product_name ?></strong>
                    </a>
                </p>
                <div>
                    <?= $product_description ?>
                </div>
            </td>
        </tr>
    </table>

    <div style="
        text-align: center;
    ">
        <a href="<?= Url::to(['/scan-to-win'], true) ?>">
            <?= Yii::t('front', 'Открыть страницу розыгрыша') ?>
        </a>
    </div>
        