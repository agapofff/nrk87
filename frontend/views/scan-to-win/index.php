<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;
    use yii\web\View;
    
    $title = Yii::t('front', 'Scan To Win') . ' - ' . Yii::$app->name;
    $this->title = Yii::$app->params['title'] ?: $title;
    
    $this->registerCSS("
        body {
            background: radial-gradient(180.55% 81.29% at 50% 100%, #3C0805 0%, #000000 100%);
        }
    ");
?>

<?php 
    Pjax::begin([
        'enablePushState' => false,
    ]);
?>

    <?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
            'options' => [
                'escapeHtml' => false,
            ]
        ]); ?>

    <div class="container-fluid">
    
        <div class="row justify-content-center">
            
            <div class="col-12 col-md-11 col-lg-10">

                <div class="row mt-4 mt-lg-5">
                    
                    <div class="col-12">
                        <h1 class="display-1 acline my-4 my-lg-5">
                            <?= Yii::t('front', 'Scan To Win') ?>
                        </h1>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-7 col-xl-8 mb-4 mb-lg-5">
                        <p>
                            <?= Yii::t('front', 'Каждый месяц случайным образом компьютер выбирает одного победителя среди клиентов бренда.') ?>
                        </p>
                        <p>
                            <?= Yii::t('front', 'Увеличьте свои шансы на выигрыш, покупая больше вещей и используя больше кодов с чеков.') ?>
                        </p>
                    </div>
                    
                    <div class="col-12 col-md-5 offset-md-1 col-lg-4 offset-lg-1 col-xl-3 offset-xl-1 mb-4 mb-lg-5">
                        <p>
                            1. <?= Yii::t('front', 'Зарегистрируйтесь') ?>
                        </p>
                        <p>
                            2. <?= Yii::t('front', 'Введите номер заказа') ?>
                        </p>
                        <p>
                            3. <?= Yii::t('front', 'Сгенерируйте номер участника') ?>
                        </p>
                        <!--
                        <p class="lead">
                            4. <?= Yii::t('front', 'Нажмите кнопку "Принять участие"') ?>
                        </p>
                        -->
                    </div>
                    
                </div>
                
                <div class="row">
                
            <?php
                if ($product) {
            ?>
                    <div class="col-12 col-xl-8 mb-5">
                    
                        <div class="row">
                        
                            <div class="col-12 col-sm-5 mb-4">
                            
                            <?php
                                $image = $product->getImage();
                                $cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.jpg';
                                $img = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x600');
                            ?>
                                <a href="<?= Url::to(['/product/' . $product->slug]) ?>" data-pjax="0">
                                    <img src="<?= $img ?>" loading="lazy" alt="<?= json_decode($product->name)->{Yii::$app->language} ?>" class="img-fluid rounded-lg- mt-2">
                                </a>
                                
                            </div>
                            
                            <div class="col-12 col-sm-7 d-flex">
                                <div class="row">
                                    <div class="col-12 align-self-start">
                                        <h3 class="acline display-4 mb-4">
                                            <?= Yii::t('front', 'Текущий розыгрыш') ?>
                                        </h3>
                                        <h2 class="acline mb-4 mb-lg-5 display-3">
                                            <a href="<?= Url::to(['/product/' . $product->slug]) ?>" class="acline" data-pjax="0">
                                                <?= json_decode($product->name)->{Yii::$app->language} ?>
                                            </a>
                                        </h2>
                                        <?= json_decode($product->text)->{Yii::$app->language} ?>
                                    </div>
                                    
                                    <div class="col-12 align-self-end">
                                    
                                        <div class="row justify-content-between">
                                    <?php 
                                        if ($price) {
                                    ?>
                                            <div class="col-auto">
                                                <p class="lead">
                                                    <?= Yii::$app->formatter->asCurrency($price, Yii::$app->params['currency']) ?>
                                                </p>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($previous) {
                                    ?>
                                            <div class="col-auto text-right">
                                            
                                                <a href="#prev" data-toggle="modal" class="text-underline">
                                                    <?= Yii::t('front', 'Прошлые розыгрыши') ?>
                                                </a>
                                            
                                            </div>
                                    <?php
                                        }
                                    ?>
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                        
                    </div>
            <?php
                }
            ?>
            
            <?php
                if ($current) {
            ?>
                    
                    <div class="col-12 col-xl-3 offset-xl-1">
                    
                        <h3 class="h2 acline count_users">
                            <?= str_replace(
                                    $countUsers,
                                    '<span>' . $countUsers . '</span>',
                                    Yii::t('front', '{number, plural, one{# участник} few{# участника} many{# участников} other{# участника}}', [
                                        'number' => $countUsers,
                                    ])
                                )
                            ?>
                        </h3>

                        <h3 class="h2 acline count_codes">
                            <?= str_replace(
                                    $countCodes,
                                    '<span>' . $countCodes . '</span>',
                                    Yii::t('front', '{number} участвующих номеров', [
                                        'number' => $countCodes,
                                    ])
                                )
                            ?>
                        </h3>
                        
                        <div id="scan-to-win" class="my-4 my-lg-5">
                        
                        <?php
                            if (Yii::$app->user->isGuest) {
                        ?>
                        
                            <?= Html::a(Html::tag('span') . Yii::t('front', 'Зарегистрироваться'), [
                                    '/register'
                                ], [
                                    'class' => 'btn btn-nrk ml-4',
                                    'title' => Yii::t('front', 'Зарегистрироваться'),
                                    'data-pjax' => 0,
                                ]);
                            ?>
                        
                        <?php
                            } else {
                        ?>
                                <?php
                                    $form = ActiveForm::begin([
                                        // 'id' => 'scan-to-win-form',
                                        // 'action' => Url::to(['/scan-to-win/add']),
                                        'options' => [
                                            'class' => 'disabling',
                                            'data-pjax' => true,
                                        ],
                                    ]);
                                ?>
                                
                                    <div class="form-group my-4 my-lg-5">
                                        <?= $form
                                                ->field($model, 'order_id', [
                                                    'inputOptions' => [
                                                        'class' => 'form-control mb-0 px-0 w-auto',
                                                        'autocomplete' => rand(),
                                                        'placeholder' => ' ',
                                                    ],
                                                    'options' => [
                                                        'class' => 'form-group mb-5 position-relative floating-label',
                                                    ],
                                                    'template' => '{input}{label}{hint}{error}',
                                                ])
                                                ->label(Yii::t('front', 'Введите номер заказа'))
                                                ->hint($orderNotFound ? '<br>' . Yii::t('app', 'Указанный Вами заказ не найден') . '.<br>' . Yii::t('app', 'Обратитесь в службу поддержки через иконку "Наушники" в приложении Sessia или на почту') . ' <a href="mailto:' . Yii::t('app', 'info@nrk1987.com') . '?subject=' . Yii::t('app', 'Заказ не найден') . ' - ' . $order_id . '" class="text-underline">' . Yii::t('app', 'info@nrk1987.com') . '</a>' : '')
                                        ?>
                                    </div>
                                    
                                    <div class="form-group my-4 my-lg-5">
                                        <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Участвовать'), [
                                                'class' => 'btn-nrk',
                                                'title' => Yii::t('front', 'Участвовать'),
                                            ])
                                        ?>
                                    </div>
                                    
                                <?php ActiveForm::end(); ?>
                                
                        <?php
                            }
                        ?>
                            
                        </div>
                        
                <?php
                    if (!empty($codes)) {
                ?>
                        <div class="my-4 my-lg-5">
                            <p class="h2 acline">
                                <?= Yii::t('front', 'Мои коды') ?>
                            </p>
                        <?php
                            foreach ($codes as $code) {
                        ?>
                                <p class="h3 acline 
                                    <?php if ($code['won']) { ?>text-success<?php } ?> 
                                    <?php if (!$code['active']) { ?>text-line-through<?php } ?>
                                ">
                                    <?= $code['id'] ?>
                                </p>
                        <?php
                            }
                        ?>
                        </div>
                <?php
                    }
                ?>
                        
                    </div>
                    
            <?php
                } else {
            ?>
            
                    <div class="col-12">
                        <a href="#prev" data-toggle="modal" class="text-underline">
                            <?= Yii::t('front', 'Прошлые розыгрыши') ?>
                        </a>
                    </div>
            
            <?php
                }
            ?>
                
                </div>
                
            </div>
            
        </div>
        
    </div>

    <?php
        if ($previous) {
    ?>
        <div id="prev" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
                                <line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
                            </svg>
                        </div>
                        
                        <div id="pastDrawings" class="carousel slide" data-interval="false" data-touch="true" data-ride="carousel">
                            <div class="carousel-inner">
                        <?php
                            foreach ($previous as $key => $prev) {
                                $product = null;
                                if ($products) {
                                    foreach ($products as $prod) {
                                        if ($prod->id == $prev->product_id) {
                                            $product = $prod;
                                            break;
                                        }
                                    }
                                    if ($product) {
                        ?>
                                        <div class="carousel-item<?= $key ? '' : ' active' ?>">

                                            <div class="row mb-4">
                                                <div class="col-12 text-center">
                                                    <p class="h2 acline">
                                                        <?= Yii::$app->formatter->asDate($prev->date_start) ?>
                                                        -
                                                        <?= Yii::$app->formatter->asDate($prev->date_end) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-5">
                                                <?php
                                                    $image = $product->getImage();
                                                    $cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.jpg';
                                                    $img = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x600');
                                                ?>
                                                    <a href="<?= Url::to(['/product/' . $product->slug]) ?>" data-pjax="0">
                                                        <img src="<?= $img ?>" loading="lazy" alt="<?= json_decode($product->name)->{Yii::$app->language} ?>" class="img-fluid rounded-lg mt-2 mb-4">
                                                    </a>
                                                </div>
                                                <div class="col-12 col-sm-7 d-flex">
                                                    <div class="row">
                                                        <div class="col-12 align-self-start">
                                                            <h2 class="acline mb-4 display-4">
                                                                <a href="<?= Url::to(['/product/' . $product->slug]) ?>" class="acline" data-pjax="0">
                                                                    <?= json_decode($product->name)->{Yii::$app->language} ?>
                                                                </a>
                                                            </h2>
                                                            <?= json_decode($product->text)->{Yii::$app->language} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 col-sm-4 text-center">
                                                    <p class="h2 acline">
                                                        <?= Yii::t('front', 'Победитель') ?>:
                                                    </p>
                                                </div>
                                                <div class="col-6 col-sm-4">
                                                    <p class="h2 acline text-center">
                                                        <?= $winners[$prev->id]['phone'] ?>
                                                    </p>                                                    
                                                </div>
                                                <div class="col-6 col-sm-4">
                                                    <p class="h2 acline text-center">
                                                        <?= $winners[$prev->id]['code'] ?>
                                                    </p>                                                    
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                            </div>
                            <a class="carousel-control-prev" href="#pastDrawings" role="button" data-slide="prev" style="left: -6em">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="25" cy="25" r="24.75" stroke="white" stroke-width="0.5"/>
                                    <path d="M21.6863 25.0006L27.5598 28.3917L27.5598 21.6096L21.6863 25.0006Z" fill="white"/>
                                </svg>
                            </a>
                            <a class="carousel-control-next" href="#pastDrawings" role="button" data-slide="next" style="right: -6em">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle r="24.75" transform="matrix(-1 0 0 1 25 25)" stroke="white" stroke-width="0.5"/>
                                    <path d="M28.3137 25.0006L22.4402 28.3917L22.4402 21.6096L28.3137 25.0006Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>


<?php
    Pjax::end();
?>