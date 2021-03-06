<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Experts */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="experts-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
        <div class="checkbox">
            <?= $form
                    ->field($model, 'publish')
                    ->checkbox();
            ?>
        </div>

        <?= $form
                ->field($model, 'title_ru')
                ->textInput(['maxlength' => true])
        ?>

        <?= $form
                ->field($model, 'title_vi')
                ->textInput(['maxlength' => true])
        ?>

        <?= $form
                ->field($model, 'description_ru')
                ->textInput(['maxlength' => true])
        ?>

        <?= $form
                ->field($model, 'description_vi')
                ->textInput(['maxlength' => true])
        ?>
        
        <?= $form
                ->field($model, 'imageFile')
                ->fileInput([
                    'class' => 'image-input'
                ])
        ?>
        <div id="experts-imagefile-embed" class="form-group">
        <?php if ($model->image) { ?>
            <img src="<?= $model->image ?>" class="img-responsive">
        <?php } ?>
        </div>

        <?= $form
                ->field($model, 'image')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'created_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'updated_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'saveAndExit')
                ->hiddenInput(['class' => 'saveAndExit'])
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-floppy-saved'
            ]) . '&nbsp;' . Yii::t('back', '??????????????????'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
            
            <?php if ($model->id) { ?>
                <?= Html::submitButton(Html::tag('span', '', [
                    'class' => 'glyphicon glyphicon-floppy-remove'
                ]) . '&nbsp;' . Yii::t('back', '?????????????????? ?? ??????????????'), [
                    'class' => 'btn btn-default btn-lg saveAndExit'
                ]) ?>
            <?php } ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end(); ?>