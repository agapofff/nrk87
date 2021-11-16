<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    
    $title = Yii::t('front', Yii::$app->params['boutiquePlaces'][$category]) . ' - ' . Yii::$app->name;
    $this->title = strip_tags(Yii::$app->params['title'] ?: $title);
?>

    <div class="container-fluid position-relative my-4 my-lg-5">
    
        <div class="row">
        
            <div class="col-12 col-md-2 col-lg-1">
            
                <div id="boutique-place-dropdown-container">
                    <div id="boutique-place-dropdown" class="dropdown">
                        <a href="#" class="media text-nowrap text-right align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media-body">
                                <div class="display-4 acline">
                                    <?= Yii::t('front', Yii::$app->params['boutiquePlaces'][$category]) ?>
                                </div>
                            </div>
                            <?= Html::img('/images/contacts/' . $category . '.png', [
                                    'class' => 'align-self-center ml-4',
                                    'style' => '
                                        width: 54px;
                                    ',
                                ])
                            ?>
                        </a>
                        
                        <div class="dropdown-menu m-0 py-0 px-5 bg-black border-0">
                        <?php
                            foreach (Yii::$app->params['boutiquePlaces'] as $key => $val){
                                if ($key != $category){
                        ?>
                                    <a href="<?= Url::to(['/contacts/' . $key]) ?>" class="media text-nowrap text-right align-items-center">
                                        <div class="media-body">
                                            <div class="display-4 acline">
                                                <?= Yii::t('front', $val) ?>
                                            </div>
                                        </div>
                                        <?= Html::img('/images/contacts/' . $key . '.png', [
                                                'class' => 'align-self-center ml-4',
                                                'style' => '
                                                    width: 54px;
                                                ',
                                            ])
                                        ?>
                                    </a>
                        <?php
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
            
            </div>
            
            <div class="col-12 col-md-10 col-lg-4 col-xl-3">
            
                <div id="boutique-place" class="owl-carousel owl-theme owl-fade" data-items="1-1-1-1-1-1" data-loop="true">
                
                <?php
                    foreach ($boutiques as $key => $boutique){
                ?>
                        <div class="boutique-place bg-black" data-id="<?= $key ?>">
                        
                            <h1 class="display-3 acline mb-5">
                                <?= json_decode($boutique->name)->{Yii::$app->language} ?>
                            </h1>
                        
                            <div class="boutique-description">
                                <?= json_decode($boutique->description)->{Yii::$app->language} ?>
                            </div>
                            
                        </div>
                <?php
                    }
                ?>
                    
                </div>
            
            </div>
            
            <div class="col-12 col-lg-7 col-xl-8 px-md-0">
            
                <div id="map" class="position-relative">
            
                    <?= Html::img('/images/contacts/map_' . $category . '.png', [
                            'class' => 'img-fluid',
                            'style' => '
                                -webkit-transform: scale(1.2);
                                -moz-transform: scale(1.2);
                                transform: scale(1.2);
                                pointer-events: none;
                            ',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                <?php
                    foreach ($boutiques as $key => $boutique){
						$boutiqueName = json_decode($boutique->name)->{Yii::$app->language};
						
                        switch ($boutique->note_position){
                            case 0: $position = 'bottom: 0.5em; left: 0.5em;'; break;
                            case 1: $position = 'top: 0.5em; left: 0.5em;'; break;
                            case 2: $position = 'top: 0.5em; right: 0.5em;'; break;
                            case 3: $position = 'bottom: 0.5em; right: 0.5em;'; break;
                        }

                        if ($boutique->hasImage()){
                            $images = $boutique->getImages();

                            $gallery = '';
                            foreach ($images as $k => $image){
                                $gallery .= '<div class="carousel-item' . ($k ? '' : ' active') . '"><img src="' . $image->getUrl() . '" class="rounded-lg img-fluid" loading="lazy"></div>';
                            }
                            $gallery .= '</div></div>';
						?>
							<div id="boutique-gallery-<?= $key ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="w-100 text-center font-weight-light">
												<?= $boutiqueName ?>
											</h4>
											<div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
												<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
													<line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
													<line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
												</svg>
											</div>
										</div>
										<div class="modal-body">
											<div id="boutique-place-carousel-<?= $key ?>" class="carousel slide" data-interval="false" data-touch="true" data-ride="carousel">
												<div class="carousel-inner">
											<?php
												foreach ($images as $k => $image){
											?>
													<div class="carousel-item<?= $k ? '' : ' active' ?>">
														<img src="<?= $image->getUrl('1500x') ?>" alt="<?= $boutiqueName ?> - <?= Yii::$app->name ?>" class="img-fluid">
													</div>
											<?php
												}
											?>
												</div>
												<a class="carousel-control-prev" href="#boutique-place-carousel-<?= $key ?>" role="button" data-slide="prev" style="left: -6em">
													<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="25" cy="25" r="24.75" stroke="white" stroke-width="0.5"/>
														<path d="M21.6863 25.0006L27.5598 28.3917L27.5598 21.6096L21.6863 25.0006Z" fill="white"/>
													</svg>
												</a>
												<a class="carousel-control-next" href="#boutique-place-carousel-<?= $key ?>" role="button" data-slide="next" style="right: -6em">
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
                            
                            echo Html::button(Html::tag('span', $boutiqueName, [
                                    'class' => 'display-4 acline text-white text-nowrap position-absolute',
                                    'style' => $position,
                                ]), [
                                    'class' => 'btn-map rounded-circle bg-danger border-0 position-absolute place-' . $key,
                                    'style' => '
                                        width: 25px;
                                        height: 25px;
                                        top: ' . $boutique->cssTop . '%;
                                        left: ' . $boutique->cssLeft . '%;
                                    ',
                                    'data' => [
                                        'id' => $key,
                                        'toggle' => 'popover',
                                        'container' => '#map',
                                        'trigger' => 'focus',
                                        'content' => Html::img($boutique->getImage()->getUrl('300x200'), [
											'alt' => $boutiqueName . ' - ' . Yii::$app->name,
											'class' => 'boutique-gallery-' . $key,
										]),
                                        'placement' => ($boutique->id == 3 ? 'left' : 'right'),
                                        'boundary' => 'viewport',
                                        'template' => '<div class="popover bg-transparent rounded-lg overflow-hidden shadow-red border-0 boutique-preview cursor-pointer"  role="tooltip"><div class="popover-body bg-black rounded-lg p-0"></div></div>',
                                    ],
                                ]);
                        } else {
                            echo Html::button(Html::tag('span', json_decode($boutique->name)->{Yii::$app->language}, [
                                    'class' => 'display-4 acline text-white text-nowrap position-absolute',
                                    'style' => $position,
                                ]), [
                                    'class' => 'btn-map rounded-circle bg-danger border-0 position-absolute place-' . $key,
                                    'style' => '
                                        width: 25px;
                                        height: 25px;
                                        top: ' . $boutique->cssTop . '%;
                                        left: ' . $boutique->cssLeft . '%;
                                    ',
                                    'data' => [
                                        'id' => $key,
                                    ],
                                ]);
                        }
                    }
                ?>
                
                    <div class="boutique-place-buttons text-nowrap position-absolute" style="bottom: 0; right: 1em;">
                    
                        <button type="button" class="btn btn-link rounded-circle boutique-place-prev px-2" onclick="$('#boutique-place').trigger('prev.owl.carousel');">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.5" r="25" transform="matrix(1 8.74228e-08 8.74228e-08 -1 25 25)" fill="#9B1C14"/>
                                <path d="M21.686 24.9994L27.5595 21.6083L27.5595 28.3904L21.686 24.9994Z" fill="white"/>
                            </svg>
                        </button>
                        
                        <button type="button" class="btn btn-link rounded-circle boutique-place-next px-2" onclick="$('#boutique-place').trigger('next.owl.carousel');">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.5" cx="25" cy="25" r="25" transform="rotate(-180 25 25)" fill="#9B1C14"/>
                                <path d="M28.314 24.9994L22.4405 21.6083L22.4405 28.3904L28.314 24.9994Z" fill="white"/>
                            </svg>
                        </button>
                        
                    </div>
                    
                </div>
            
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
                        
                        $('.btn-map.place-' + index).trigger('focus');
                    }
                });
                
                $('.btn-map').on('click', function(){
                    var id = $(this).data('id');
                    $('#boutique-place').data('owl.carousel').to(id);
                });
            ",
            View::POS_READY,
            'boutique-place'
        );
    ?>
	
	<?php
		$this->registerJs(
			"
				$(document).on('click', '.boutique-preview', function(){
					$('#' + $(this).find('img').attr('class')).modal('show');
				});
			",
			View::POS_READY,
			'boutique-gallery'
		);
	?>