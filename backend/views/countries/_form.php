<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Countries */
/* @var $form yii\widgets\ActiveForm */

?>

<?php Pjax::begin(); ?>

<div class="countries-form">

    <select id="sessia_countries" class="form-control">
        <option>Выберите страну</option>
    </select>

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
                ->field($model, 'code')
                ->textInput([
                    'type' => 'number'
                ])
        ?>

        <?= $form
                ->field($model, 'country_id')
                ->textInput([
                    'type' => 'number'
                ])
        ?>

        <?= $form
                ->field($model, 'name')
                ->textInput([
                    'maxlength' => true
                ])
        ?>
        
        <?= $form
                ->field($model, 'lang')
                ->textInput([
                    'maxlength' => true
                ])
        ?>
        
        <?= $form
                ->field($model, 'mask')
                ->textInput([
                    'maxlength' => true
                ])
        ?>
        
        <?= $form
                ->field($model, 'icon')
                ->textInput([
                    'maxlength' => true
                ])
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
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
            
            <?php if ($model->id) { ?>
                <?= Html::submitButton(Html::tag('span', '', [
                    'class' => 'glyphicon glyphicon-floppy-remove'
                ]) . '&nbsp;' . Yii::t('back', 'Сохранить и закрыть'), [
                    'class' => 'btn btn-default btn-lg saveAndExit'
                ]) ?>
            <?php } ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end(); ?>