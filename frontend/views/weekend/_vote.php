<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\Votes */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="content" class="votes-form">

<?php
    Pjax::begin([
        'id' => 'vote-pjax',
        'enablePushState' => false
    ]);
?>

    <?php
        if ($voted){
            $sum = array_sum(ArrayHelper::getColumn($results, 'votes'));
    ?>
    
            <div id="vote-results">
                <div class="row align-items-center">
            <?php
                $i = 0;
                foreach ($results as $result){
                    $percent = ($result['votes'] / $sum) * 100;
            ?>
                    <div class="col-12">
                        <div class="progress my-4">
                            <div class="progress-bar bg-<?= Yii::$app->params['colors'][$i] ?> display-4" role="progressbar" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percent ?>%">
                                <?= round($percent) ?>%
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;
                }
            ?>
                </div>
                <div class="row justify-content-end align-items-center mt-3">
            <?php
                $i = 0;
                foreach ($results as $result){
            ?>
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 text-left">
                        <span class="badge badge-pill rounded-pill badge-<?= Yii::$app->params['colors'][$i] ?>">&nbsp;</span>
                        <p class="lead"><?= $result['title_'.Yii::$app->language] ?></p>
                    </div>
                    <div class="w-100"></div>
            <?php
                    $i++;
                }
            ?>
                </div>
            </div>

    <?php
        } else {
    ?>
    
            <div class="row align-items-center">
            <?php
                $i = 0;
                foreach ($answers as $answer){
            ?>
                <div class="col-12 my-4">
                    <?= Html::button($answer->{'title_'.Yii::$app->language}, [
                            'class' => 'btn btn-lg btn-vote px-5 py-3 rounded-pill btn-'.Yii::$app->params['colors'][$i],
                            'data-value' => $answer->id
                        ])?>
                </div>
            <?php
                    $i++;
                }
            ?>
            </div>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'vote-form',
                    'action' => '/weekend/vote',
                    'validateOnBlur' => false,
                    'options' => [
                        // 'class' => 'ajax',
                        'data' => ['pjax' => true],
                    ]
                ]);
            ?>

                <?= $form
                        ->field($model, 'question_id')
                        ->hiddenInput([
                            'value' => $questions->id
                        ])
                        ->label(false);
                ?>

                <?= $form
                        ->field($model, 'answer_id')
                        ->hiddenInput()
                        ->label(false);
                ?>

                <?= $form
                        ->field($model, 'ip')
                        ->hiddenInput([
                            'value' => Yii::$app->request->userIP
                        ])
                        ->label(false)
                ?>

                <?= $form
                    ->field($model, 'created_at')
                    ->hiddenInput([
                        'value' => date('Y-m-d H:i:s')
                    ])
                    ->label(false)
                ?>

                <?= $form
                    ->field($model, 'updated_at')
                    ->hiddenInput([
                        'value' => date('Y-m-d H:i:s')
                    ])
                    ->label(false)
                ?>

            <?php ActiveForm::end(); ?>
            
    <?php
        }
    ?>
    
    <?php
        if (Yii::$app->session->hasFlash('success')){
            $this->registerJs(
                'toastr.success("'.Yii::$app->session->getFlash('success').'");
                $.pjax.reload("#vote-pjax");',
                View::POS_READY,
                'vote-success-'.date('YmdHis')
            );
        }
    ?>

    <?php
        if (Yii::$app->session->hasFlash('error')){
            $this->registerJs(
                'toastr.error("'.Yii::$app->session->getFlash('error').'");
                $(".btn-vote").removeClass("disabled");',
                View::POS_READY,
                'vote-error-'.date('YmdHis')
            );
        }
    ?>
    
<?php Pjax::end(); ?>

</div>

