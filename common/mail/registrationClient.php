<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<div class="wrapper" style="background: #81b722; padding: 50px 20px; font-family: Arial; color: #fff; height: 100%; box-sizing: border-box; overflow: auto;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="max-width: 150px">
            <img src="https://f3events.online/images/email/logo.png">
        </div>
        <div style="height: 1px; background: rgba(255, 255, 255, 0.25); margin: 25px 0 25px 0;"></div>
        <div style="height: 1px; background: rgba(255, 255, 255, 0.25); margin: 25px 0 25px 0;"></div>

        <table>
            <tr>
                <td style="color: #3b4607; font-size: 30px; padding: 0 0 20px 0;">
                    <?= Yii::$app->formatter->asDate($common->{'datetime_'.Yii::$app->language}, 'dd') ?>/<?= Yii::$app->formatter->asDate($common->{'datetime_'.Yii::$app->language}, 'MM') ?>
                </td>
                <td style="padding: 0 5px;">
                    <img src="https://f3events.online/images/email/splash.png">
                </td>
                <td style="padding: 20px 0 0px 0;">
                    <table>
                        <tr>
                            <td style="font-size: 30px; vertical-align: bottom;">
                                <?= Yii::$app->formatter->asTime($common->{'datetime_'.Yii::$app->language}, 'HH:mm') ?>
                            </td>
                            <td style="font-size: 15px; vertical-align: bottom; padding: 0 0 6px 3px;">
                                <?= Yii::t('app', '(МСК)') ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="title1" style="font-size: 25px; font-weight: bold; margin: 50px 0 5px 0;">
            <?= strtoupper(Yii::$app->name) ?>
        </div>

        <div class="title1" style="font-size: 25px; font-weight: bold; margin: 0px 0 20px 0;">
            <?= Yii::t('app', 'БЕСПЛАТНЫЙ <nobr>СЕМИНАР</nobr>') ?>
        </div>

        <div class="title1" style="font-size: 20px; line-height: 30px; margin: 20px 0 50px 0;">
            <?= Yii::t('app', 'Поздравляем') ?>, 
            <span style="font-weight: bold;"><?= $name ?></span>!<br>
            <?= Yii::t('app', 'Вы зарегистрировались для участия в') ?> <?= Yii::$app->name ?>!
        </div>

        <div class="">
            <div class="" style="color: #3b4607;
                margin: 0 0 10px 0;
                font-size: 20px;
                font-weight: bold;">
                <?= Yii::t('app', 'Ваш номер участника') ?>:
            </div>
            <div class="" style="background: #fff;
                padding: 6px 15px;
                color: #000;
                display: inline-block;
                vertical-align: top;
                font-size: 25px;
                letter-spacing: 5px;
                margin: 0 0 50px 0;
                ">
                <?= $client_id ?>
            </div>
        </div>

        <div>
            <p style="font-size: 18px; line-height: 24px; margin: 15px 0 10px 0;">
                <?= Yii::t('app', 'Для подтверждения личности нужно будет назвать номер участника, отправленный в этом письме.') ?></p>
        </div>

        <div style="height: 1px; background: rgba(255, 255, 255, 0.25); margin: 25px 0 45px 0;"></div>
                            
        <div>
            <p style="font-size: 18px; line-height: 24px; margin: 20px 0 10px 0; text-align: center;">
                <?= Yii::t('app', 'Спонсоры') ?>:</p>
        </div>

        <table style="margin: 0 auto;">
            <tr>
                <td style="width: 108px">
                    <img src="https://f3events.online/images/email/projectV.png">
                </td>
                <td style="padding: 0 5px;">
                    <img style="margin: 0 0 9px 0;" src="https://f3events.online/images/email/splash.png">
                </td>
                <td style="width: 93px">
                    <img style="margin: 17px 0 0 0;" src="http://f3events.online/images/email/cof.png">
                </td>
            </tr>
        </table>

    </div>
</div>