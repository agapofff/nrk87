<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

// use kartik\alert\AlertBlock;


/* @var $this yii\web\View */
/* @var $model frontend\models\Registration */
/* @var $form ActiveForm */

?>

<div id="content">

<?php
    Pjax::begin([
        'id' => 'registration-pjax',
        'enablePushState' => false
    ]);
?>

    <div class="weekend-registration">

        <?php $form = ActiveForm::begin([
                'id' => 'registration-form',
                'action' => '/weekend/registration',
                'validateOnBlur' => false,
                'options' => [
                    'data' => ['pjax' => true],
                ]
            ]);
        ?>

            <?= $form
                    ->field($model, 'name')
                    ->textInput([
                        'maxlength' => true,
                    ])
                    ->label(Yii::t('front', 'Имя'));
            ?>

            <?= $form
                    ->field($model, 'country')
                    ->dropDownList(ArrayHelper::map($countries, 'id', 'name'), [
                        'options' => ArrayHelper::map($countries, 'id', function($data) {
                            return [
                                'data-code' => $data['code'],
                                'data-icon' => $data['icon'],
                                'data-lang' => $data['lang'],
                                'data-country-id' => $data['country_id'],
                                'data-phone-mask' => $data['mask'],
                                'selected' => (
                                    (Yii::$app->language == 'ru' && $data['country_id'] == '1')
                                    || (Yii::$app->language == 'vi' && $data['country_id'] == '1055')
                                    ? true : false
                                )
                                // ($data['lang'] == Yii::$app->language ? true : false)
                            ];
                        }),
                        'data' => [
                            'live-search' => 'true',
                            'none-selected-text' => Yii::t('front', 'Не выбрано'),
                            'none-results-text' => Yii::t('front', 'Не найдено'),
                            'select-on-tab' => true,
                        ]
                    ])
                    ->label(Yii::t('front', 'Страна'));
            ?>
            
            <div class="position-relative">
                <?php
                    echo $form
                        ->field($model, 'phone')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'form-control phone',
                        ])
                        ->label(Yii::t('front', 'Телефон'));
                ?>
                <div id="phone-code" class="position-absolute text-right d-flex align-items-center justify-content-end pr-2"></div>
            </div>

            <?= $form
                    ->field($model, 'email')
                    ->textInput([
                        'maxlength' => true,
                    ])
                    ->label(Yii::t('front', 'E-mail'));
            ?>
            
            <?= $form
                    ->field($model, 'datetime')
                    ->hiddenInput([
                        'maxlength' => true,
                        'value' => $common->{'datetime_'.Yii::$app->language}
                    ])
                    ->label(false);
            ?>
            
            <?= $form
                    ->field($model, 'event')
                    ->hiddenInput([
                        'maxlength' => true,
                        'value' => $common->{'title_'.Yii::$app->language}
                    ])
                    ->label(false);
            ?>

            <?= $form
                    ->field($model, 'promocode')
                    ->hiddenInput([
                        'maxlength' => true,
                        'value' => Yii::$app->params['promocode'],
                    ])
                    ->label(false)
            ?>
            
            <?= $form
                    ->field($model, 'client_id')
                    ->hiddenInput([
                        'maxlength' => true
                    ])
                    ->label(false);
            ?>
            
            
            <div class="agree">
            <?= Html::checkbox('agree', true, [
                    'label' => Yii::t('front', 'Оставляя контактные данные, вы соглашаетесь с <a href="https://f3tour.club/docs/Политика%20конфиденциальности.pdf" target="_blank" class="text-white text-decoration-underline">политикой конфиденциальности</a> и даете согласие на обработку персональных данных'),
                    'id' => 'registration-agree',
                ])
            ?>
            </div>
            
            <div class="form-group text-center mt-3">
                <?= Html::submitButton(
                        Html::tag('div', '', [
                            'class' => 'spinner-border text-light m-1 mr-2 spinner-border-sm',
                            'role' => 'status'
                        ]) . Yii::t('front', 'Регистрация') . Html::tag('span', '', [
                            'class' => 'icon-arrow'
                        ]), [
                            'id' => 'registration-submit',
                            'class' => 'btn btn-primary btn-lg rounded-pill text-light text-nowrap px-4'
                        ]
                    )
                ?>
            </div>
            
        <?php ActiveForm::end(); ?>

    </div>
    
    <?php
        $this->registerJs(
            "loadCountryData();",
            View::POS_READY,
            'load-country-data-'.date('YmdHis')
        );
    ?>
    
    <?php
        if (Yii::$app->session->hasFlash('success')) {
            $this->registerJs(
                'toastr.success("'.Yii::$app->session->getFlash('success').'");
                registrationSuccess();',
                View::POS_READY,
                'registration-success-'.date('YmdHis')
            );
        }
    ?>
    
    <?php
        if (Yii::$app->session->hasFlash('error')) {
            $this->registerJs(
                'toastr.error("'.Yii::$app->session->getFlash('error').'");',
                View::POS_READY,
                'registration-success-'.date('YmdHis')
            );
        }
    ?>

<?php Pjax::end(); ?>

</div>