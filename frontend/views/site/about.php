<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    
    $title = Yii::t('front', 'О бренде') . ' - ' . Yii::$app->name;
    $this->title = strip_tags(Yii::$app->params['title'] ?: $title);
?>


    <div class="container-fluid position-relative mb-4 mb-lg-5">

        <div class="row mt-4 mt-lg-5">
            
            <div class="col-12">
                <h1 class="display-1 acline my-4 my-lg-5 text-center">
                    <?= json_decode($founder->name)->{Yii::$app->language} ?>
                </h1>
            </div>
                    
            <div class="position-relative col-12 col-lg-7 col-xl-6 horizontal-parallax">
                <?= Html::img('/images/about/about_0_1.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: relative;
                            z-index: 3;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_0_2.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: absolute;
                            top: 0;
                            left: 50%;
                            transform: scale(1.3) translateX(-40%);
                            z-index: 2;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_0_3.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: absolute;
                            top: 0;
                            left: 0;
                            transform: scale(3) translateX(-10%) translateY(20%);
                            z-index: 2;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
            </div>
            
            <div class="col-12 col-lg-5 col-xl-6 my-5 my-lg-5 pt-4 pt-lg-5">
                <?= json_decode($founder->text)->{Yii::$app->language} ?>
            </div>
                
        </div>
            
    </div>

    <div class="vh-25"></div>

    <div class="vw-100 position-relative horizontal-parallax">
    
        <?= $this->render('@frontend/views/site/cover-socials') ?>
    
        <div class="container-fluid position-relative horizontal-parallax px-0-">

            <div class="row mt-5">
                        
                <div class="col-12 offset-4 offset-md-3 offset-lg-2 offset-xl-0 text-center">
                    
                    <?= Html::img('/images/about/about_1_2.png', [
                            'style' => '
                                position: relative;
                                z-index: 3;
                                pointer-events: none;
                            ',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                    <?= Html::img('/images/about/about_1_3.png', [
                            'style' => '
                                position: absolute;
                                bottom: -20%;
                                left: 50%;
                                transform: translateX(-40%);
                                z-index: 1;
                                pointer-events: none;
                            ',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                    <?= Html::img('/images/about/about_1_4.png', [
                            'style' => '
                                position: absolute;
                                bottom: -40%;
                                left: 50%;
                                transform: translateX(-50%);
                                z-index: 2;
                                pointer-events: none;
                            ',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                </div>
                
                <div class="col-11 col-sm-6 col-md-5 offset-md-1 col-lg-4 col-xl-3 my-5 position-absolute order-first" style="z-index: 5">
                    
                    <h2 class="display-1 acline my-5">
                        <?= json_decode($brand->name)->{Yii::$app->language} ?>
                    </h2>
                    
                    <?= json_decode($brand->text)->{Yii::$app->language} ?>
                    
                </div>
            
            </div>

        </div>
        
        <?= Html::img('/images/about/about_1_1.png', [
                'style' => '
                    position: absolute;
                    bottom: -150px;
                    left: -10%;
                    width: 120%;
                    min-width: 1300px;
                    z-index: 4;
                    pointer-events: none;
                ',
                'loading' => 'lazy',
            ])
        ?>
        
    </div>


    <div class="container-fluid position-relative horizontal-parallax">

        <div class="row">
                    
            <div class="col-7 col-sm-6 offset-sm-3 col-md-4 offset-md-0 col-lg-5 position-absolute">
                
                <?= Html::img('/images/about/about_2_1.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: relative;
                            z-index: 1;
                            pointer-events: none;
                            -webkit-transform: translate(10%, 0);
                            -moz-transform: translate(10%, 0);
                            transform: translate(10%, 0);                            
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_2_2.png', [
                        'class' => 'img-fluid',
                        'style' => '
                            position: absolute;
                            top: 0;
                            left: 0;
                            -webkit-transform: translate(40%, 10%);
                            -moz-transform: translate(40%, 10%);
                            transform: translate(40%, 10%);
                            z-index: 2;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
            </div>
            
            <div class="col-11 col-sm-7 offset-sm-4- col-md-5 offset-md-6 col-lg-5 offset-lg-7 col-xl-3 offset-xl-7 my-5" style="z-index: 5">
                
                <h2 class="display-1 acline my-5">
                    <?= json_decode($philosophy->name)->{Yii::$app->language} ?>
                </h2>
                
                <?= json_decode($philosophy->text)->{Yii::$app->language} ?>
                
            </div>
        
        </div>

    </div>


    <div class="vw-100 position-relative">
    
        <div class="vw-100 position-absolute">
        
            <div class="container-fluid vh-100 pt-5">
            
                <div class="row vh-100 align-items-center">
            
                    <div class="col-12 col-sm-10 col-md-9 offset-md-1 col-lg-7 col-xl-6 my-5 order-first" style="z-index: 5">
                        
                        <h3 class="display-1 acline my-5">
                            <?= Yii::t('front', 'Выбери место для бутика NRK87. на Марсе') ?>
                        </h3>
                        
                        <div class="row">
                        
                            <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
                        
                                <div id="boutique-place" class="owl-carousel owl-theme" data-items="1-1-1-1-1-1" data-loop="true" data-fade="true">
                                
                                    <div class="boutique-place" data-id="0">
                                    
                                        <p class="font-weight-bold">
                                            <?= json_decode($ghostDunes->name)->{Yii::$app->language} ?>
                                        </p>
                                    
                                        <?= json_decode($ghostDunes->text)->{Yii::$app->language} ?>
                                        
                                    </div>
                                    
                                    <div class="boutique-place" data-id="1">
                                    
                                        <p class="font-weight-bold">
                                            <?= json_decode($olympusVolcano->name)->{Yii::$app->language} ?>
                                        </p>
                                    
                                        <?= json_decode($olympusVolcano->text)->{Yii::$app->language} ?>
                                        
                                    </div>
                                    
                                    <div class="boutique-place" data-id="2">
                                    
                                        <p class="font-weight-bold">
                                            <?= json_decode($marinerValley->name)->{Yii::$app->language} ?>
                                        </p>
                                    
                                        <?= json_decode($marinerValley->text)->{Yii::$app->language} ?>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                           
                        </div>
                        
                        <div class="boutique-place-buttons text-nowrap">
                        
                            <button type="button" class="btn btn-link rounded-circle boutique-place-prev" onclick="$('#boutique-place').trigger('prev.owl.carousel');">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="25" cy="25" r="24.75" stroke="white" stroke-width="0.5"/>
                                    <path d="M21.6863 25.0006L27.5598 28.3917L27.5598 21.6096L21.6863 25.0006Z" fill="white"/>
                                </svg>
                            </button>
                            
                            <button type="button" class="btn btn-link rounded-circle boutique-place-next" onclick="$('#boutique-place').trigger('next.owl.carousel');">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle r="24.75" transform="matrix(-1 0 0 1 25 25)" stroke="white" stroke-width="0.5"/>
                                    <path d="M28.3137 25.0006L22.4402 28.3917L22.4402 21.6096L28.3137 25.0006Z" fill="white"/>
                                </svg>
                            </button>
                            
                            <?= Html::beginForm(['vote'], 'post', [
                                    'id' => 'boutique-place-form',
                                    'class' => 'd-inline ajax',
                                ])
                            ?>
                            
                                <?= Html::input('hidden', 'question_id', 8) ?>
                                
                                <?= Html::input('hidden', 'answer_id', 8, [
                                    'id' => 'answer_id',
                                ]) ?>
                                
                                <?= Html::input('hidden', 'lang', Yii::$app->language) ?>
                                
                                <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Голосовать'),
                                        [
                                            'class' => 'btn-nrk ml-4',
                                            'title' => Yii::t('front', 'Голосовать'),
                                        ]
                                    )
                                ?>
                                
                            <?= Html::endForm() ?>
                        
                        </div>
						
						<div class="row">
							<div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8">
								<div class="vote-results my-5"></div>
							</div>
						</div>
                        
                    </div>
                    
                </div>
            
            </div>
        
        </div>
        
        <div class="vw-100 px-0 mx-sm-0 overflow-hidden d-flex justify-content-center horizontal-parallax">
        
            <div class="position-relative vw-100"
                style="
                    min-width: 1200px;
                "
            >
                
                <?= Html::img('/images/about/about_3_2_0.png', [
                        'class' => 'place-on-mars place-0',
                        'style' => '
                            position: absolute;
                            bottom: 4%;
                            left: 15%;
                            width: 90%;
                            z-index: 3;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_3_2_1.png', [
                        'class' => 'place-on-mars place-1',
                        'style' => '
                            position: absolute;
                            bottom: 0%;
                            left: 15%;
                            width: 90%;
                            z-index: 3;
                            pointer-events: none;
                            display: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_3_2_2.png', [
                        'class' => 'place-on-mars place-2',
                        'style' => '
                            position: absolute;
                            bottom: 13%;
                            left: -5%;
                            width: 110%;
                            z-index: 3;
                            pointer-events: none;
                            display: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_3_4.png', [
                        'style' => '
                            position: absolute;
                            top: -5%;
                            left: -10%;
                            width: 120%;
                            z-index: 2;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_3_3.png', [
                        'style' => '
                            position: relative;
                            display: block;
                            width: 120%;
                            z-index: 3;
                            pointer-events: none;
                            margin-left: 4px;
                            transform: translateX(-10%);
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
                <?= Html::img('/images/about/about_3_1.png', [
                        // 'class' => 'horizontal-parallax-reverse',
                        'style' => '
                            position: absolute;
                            top: 5%;
                            left: -10%;
                            width: 120%;
                            z-index: 1;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
            </div>
                
        </div>

    </div>

    <?php
        $this->registerJs(
            "
                $('#boutique-place').on('changed.owl.carousel', function(e){
                    if (e.item){
                        var answers = [8, 9, 10],
                            index = e.item.index - 1,
                            count = e.item.count;
                            
                        if (index > count) {
                            index -= count;
                        }
                        if (index <= 0) {
                            index += count;
                        }
                        
                        index = index - 1;
                        $('#answer_id').val(answers[index]);
                        $('.place-on-mars:not(.place-' + index + ')').fadeOut();
                        $('.place-on-mars.place-' + index).fadeIn();
                    }
                });
            ",
            View::POS_READY,
            'boutique-place-vote-script'
        );
    ?>


    <?php
        // $this->registerJs(
            // "
            // $('#boutique-place-form')
                // .on('submit', function(e){
                    // e.preventDefault();
                // })
                // .on('beforeSubmit', function(e) { 
        // console.log('test');
                   // var form = $(this);
                    // $.get(form.attr('action'), form.serialize(), function(response){
        // console.log(response);
                            // var data = response;
                            // switch (data.status){
                                // case 'warning': toastr.warning(data.message); break;
                                // case 'danger': toastr.error(data.message); break;
                                // case 'error': toastr.error(data.message); break;
                                // case 'success': toastr.success(data.message); break;
                                // case 'info': toastr.info(data.message); break;
                            // }
                    // });    
                // });
            // ",
            // View::POS_READY,
            // 'boutique'
        // );
    ?>


    <div class="container-fluid px-0 horizontal-parallax">

        <div class="row no-gutters">
        
            <div class="col-12">
            
                <?= Html::img('/images/about/about_4_2.png', [
                        'style' => '
                            display: block;
                            width: 120%;
                            -webkit-transform: translateX(-10%);
                            -moz-transform: translateX(-10%);
                            transform: translateX(-10%);
                            z-index: 5;
                            pointer-events: none;
                        ',
                        'loading' => 'lazy',
                    ])
                ?>
                
            </div>
        
        </div>
        
    </div>



    <div class="container-fluid">

        <div class="row justify-content-center text-center">
        
            <div class="col-12 col-lg-11 col-xl-10 my-5">
            
                <h4 class="display-1 acline m-0">
                    <?= Yii::t('front', 'Хочешь стать исследователем Марса?') ?>
                    <br>
                    <?= Yii::t('front', 'Проверь, свою готовность к полёту!') ?>
                </h4>
            
            </div>
        
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 my-4">
            
                <p>
                    <?= Yii::t('front', 'Для колонизации Красной планеты нужны не только крепкие руки, но и светлые головы.') ?>
                </p>
                
                <p>
                    <?= Yii::t('front', 'Докажи, что ты знаешь о Марсе больше других!') ?>
                </p>
            
            </div>
            
            <div class="col-12 mt-4">
            
                <?= Html::a(Html::tag('span') . Yii::t('front', 'Начать тест'), ['test/mars'],
                        [
                            'class' => 'btn btn-nrk ml-4',
                            'title' => Yii::t('front', 'Начать тест'),
                        ]
                    )
                ?>
            
            </div>
        
        </div>

    </div>
    
    <div class="vh-100 vw-100 d-flex justify-content-center">
        <?= Html::img('/images/about/about_guiness.png', [
                'class' => 'h-100',
                'loading' => 'lazy',
            ])
        ?>
    </div>
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 my-4 my-lg-5">
                <h3 class="display-2 acline text-center mb-5">
                    <?= Yii::t('front', 'Бренд NRK87. официально внесён в Книгу рекордов Гиннесса', [
                            Yii::$app->name
                        ])
                    ?>
                </h3>
                <p class="w-100 text-center">
                    <?= Yii::t('front', 'Бренд NRK87. был официальным партнером Moscow Fashion Week и 27 октября 2018 года стал рекордсменом Книги рекордов Гиннесса в номинации «Largest attendance at a fashion show» — на показе коллекции было зафиксировано 1012 зрителей.', [
                        Yii::$app->name
                    ])
                    ?>
                </p>
            </div>
        </div>
    </div>
    
