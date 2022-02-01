<?php
/* @var $this yii\web\View */
?>

<div id="registration" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content px-3 py-2">
            <div class="modal-header">
                <h5 class="modal-title h2 font-weight-bold"><?= Yii::t('front', 'Регистрация') ?></h5>
                <div class="modal-close" data-dismiss="modal" aria-label="<?= Yii::t('front', 'Закрыть') ?>">
                </div>
            </div>
            <div class="modal-body">
                <?= $this->render('registration',[
                        'model' => $registration,
                        'common' => $common,
                        'countries' => $countries,
                    ])
                ?>
            </div>
        </div>
    </div>
</div>