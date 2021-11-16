<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;

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
    if (Yii::$app->session->hasFlash('success')){
        $this->registerJs(
            'toastr.success("'.Yii::$app->session->getFlash('success').'");
            registrationSuccess();',
            View::POS_READY,
            'vote-success-'.date('YmdHis')
        );
    }
?>

<?php
    if (Yii::$app->session->hasFlash('error')){
        $this->registerJs(
            'toastr.error("'.Yii::$app->session->getFlash('error').'");',
            View::POS_READY,
            'vote-success-'.date('YmdHis')
        );
    }
?>