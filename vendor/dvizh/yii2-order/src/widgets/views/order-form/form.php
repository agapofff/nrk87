<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    use kartik\select2\Select2;
    use yii\web\JsExpression;
    use yii\helpers\ArrayHelper;

    if (Yii::$app->session->hasFlash('orderError')){
        $errors = Yii::$app->session->getFlash('orderError');
        $orderModel->addErrors(unserialize($errors));
    }

?>

<div id="order" class="dvizh_order_form">

    <?php
        $form = ActiveForm::begin([
            'action' => Url::toRoute(['/order/order/create']),
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
            // 'enableClientValidation' => false,
            'options' => [
                'id' => 'order-form',
            ]
        ]);
    ?>
        
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

		<div class="row justify-content-between mb-3">
			<div class="col-auto">
				<p class="text-uppercase font-weight-bold">
					<?= Yii::t('front', 'Контактная информация') ?>
				</p>
			</div>
	<?php
		if (Yii::$app->user->isGuest){
	?>
			<div class="col-auto">
				<p>
					<?= Yii::t('front', 'Уже есть аккаунт?') ?>
					&nbsp;
					<?= Html::a(Yii::t('front', 'Войти'), ['/login']) ?>
				</p>
			</div>
	<?php
		}
	?>
		</div>
            
		<?= $form
				->field($orderModel, 'client_name', [
					'inputOptions' => [
						'class' => 'form-control mb-0 px-0',
						'autocomplete' => rand(),
						'placeholder' => ' ',
					],
					'options' => [
						'class' => 'form-group mb-2 position-relative floating-label',
					],
					'template' => '{input}{label}{hint}{error}',
				])
		?>

		<?= $form
				->field($orderModel, 'email', [
					'inputOptions' => [
						'class' => 'form-control mb-0 px-0',
						'autocomplete' => rand(),
						'placeholder' => ' ',
					],
					'options' => [
						'class' => 'form-group mb-2 position-relative floating-label',
					],
					'template' => '{input}{label}{hint}{error}',
				])
		?>
		
		<?= $form
				->field($orderModel, 'phone', [
					'inputOptions' => [
						'class' => 'form-control mb-0 px-0',
						'autocomplete' => rand(),
						'placeholder' => ' ',
					],
					'options' => [
						'class' => 'form-group mb-1 position-relative floating-label',
					],
					'template' => '{input}{label}{hint}{error}',
				])
		?>
		
		<div id="block-country" class="form-group mb-1 position-relative required" data-select2>
			<label class="control-label" for="country">
				<?= Yii::t('front', 'Страна') ?>
			</label>
			<?= Select2::widget([
					'id' => 'country',
					'name' => 'country',
					'value' => $fieldsDefaultValues['country_id'],
					'bsVersion' => '4.x',
					'language' => Yii::$app->language,
					'theme' => Select2::THEME_BOOTSTRAP,
					'data' => $countriesList,
					'options' => [
						'class' => 'form-control mb-0 px-0',
						'placeholder' => ' ',
						'autocomplete' => rand(),
						'options' => $countriesOptions,
					],
					'pluginOptions' => [
						'allowClear' => false,
						'dropdownParent' => new JsExpression("$('#block-country')"),
						// 'minimumInputLength' => 2,
						// 'ajax' => [
							// 'url' => Url::to('/checkout/get-cities'),
							// 'dataType' => 'json',
							// 'data' => new JsExpression("function(params){
								// return {
									// country_id:$('#order-country_id').val(),
									// lang:'" . Yii::$app->language . "',
									// q:params.term
								// };
							// }"),
						// ],
					],
				]);
			?>
			
		</div>
		
		<div id="block-city" class="form-group mb-5 position-relative required" data-select2>
			<label class="control-label" for="city">
				<?= Yii::t('front', 'Город') ?>
			</label>
			<?= Select2::widget([
					'id' => 'city',
					'name' => 'city',
					'value' => $fieldsDefaultValues['city_id'],
					'bsVersion' => '4.x',
					'language' => Yii::$app->language,
					'theme' => Select2::THEME_BOOTSTRAP,
					'data' => $citiesList,
					'options' => [
						'class' => 'form-control mb-0 px-0',
						'placeholder' => ' ',
						'autocomplete' => rand(),
					],
					'pluginOptions' => [
						'allowClear' => false,
						'dropdownParent' => new JsExpression("$('#block-city')"),
						// 'minimumInputLength' => 0,
						'ajax' => [
							'url' => Url::to(['/checkout/get-cities']),
							'dataType' => 'json',
							'data' => new JsExpression("
								function(params){
									return {
										country_id:$('#country').val(),
										lang:'" . Yii::$app->language . "',
										q:params.term
									};
								}
							"),
							// 'transport' => new JsExpression("
								// function(params, success, failure){
									// var request = $.ajax(params);

									// request.then(function(){
										// console.log('city success');
									// });
									// request.fail(failure);

									// return request;
								// }
							// "),
						],
					],
				]);
			?>
		</div>
				
		
		<div class="row justify-content-between mt-5 mb-3">
			<div class="col-auto">
				<p class="text-uppercase font-weight-bold m-0">
					<?= Yii::t('front', 'Доставка') ?>
				</p>
			</div>
		</div>
		
		<?= $form
				->field($orderModel, 'shipping_type_id')
				->hiddenInput()
				->label(false)
		?>
	
		<div class="form-group row" role="tablist">
			<?php
				foreach($shippingTypesList as $key => $sht){
			?>
					<div class="col-auto">
						<div class="custom-control custom-radio mr-3">
							<input 
								type="radio" 
								id="shipping-type-tab-link-<?= $sht->id ?>" 
								name="shipping_type_switcher" 
								value="<?= $sht->id ?>" 
								class="custom-control-input" 
								data-target="#shipping-type-tab-<?= $sht->id ?>" 
								<?php if ($orderModel->shipping_type_id == $sht->id){?>
									checked
								<?php } ?>
							>
							<label class="custom-control-label" for="shipping-type-tab-link-<?= $sht->id ?>">
								<?= Yii::t('front', $sht->name) ?>
							</label>
						</div>
					</div>
			<?php
				}
			?>
		</div>
	
		<div class="tab-content mb-1">
		
	<?php
		foreach($shippingTypesList as $key => $sht){
	?>  
			<div 
				class="tab-pane mt-3 <?php if ($key == 0){?>active<?php } ?>" 
				id="shipping-type-tab-<?= $sht->id ?>" 
			>

		<?php
			if ($sht->id == 1){
		?>
				<div id="block-delivery" class="form-group position-relative">
					<label class="control-label" for="pickup">
						<?= Yii::t('front', 'Способ доставки') ?>
					</label>
					<?= Select2::widget([
							'id' => 'delivery',
							'name' => 'delivery',
							'value' => $fieldsDefaultValues['delivery_id'],
							'bsVersion' => '4.x',
							'language' => Yii::$app->language,
							'theme' => Select2::THEME_BOOTSTRAP,
							'data' => $deliveryList,
							'options' => [
								'class' => 'form-control mb-0 px-0',
								'placeholder' => Yii::t('front', 'Выберите способ доставки'),
								'autocomplete' => rand(),
							],
							'pluginOptions' => [
								'allowClear' => false,
								'dropdownParent' => new JsExpression("$('#block-delivery')"),
								// 'minimumInputLength' => 2,
								'ajax' => [
									'url' => Url::to(['/checkout/get-delivery']),
									'dataType' => 'json',
									'data' => new JsExpression("function(params){
										return {
											country_id:$('#country').val(),
											city_id:$('#city').val(),
											type:'delivery',
											q:params.term
										};
									}"),
								],
							],
						]);
					?>
				</div>			
		<?php
			}
		?>
			
		<?php
			if ($sht->id == 2){
		?>
				<div id="block-pickup" class="form-group position-relative">
					<label class="control-label" for="pickup">
						<?= Yii::t('front', 'Пункт самовывоза') ?>
					</label>
					<?= Select2::widget([
							'id' => 'pickup',
							'name' => 'pickup',
							'value' => $fieldsDefaultValues['delivery_id'],
							'bsVersion' => '4.x',
							'language' => Yii::$app->language,
							'theme' => Select2::THEME_BOOTSTRAP,
							'data' => $pickupsList,
							'options' => [
								'class' => 'form-control mb-0 px-0',
								'placeholder' => Yii::t('front', 'Выберите пункт самовывоза'),
								'autocomplete' => rand(),
							],
							'pluginOptions' => [
								'allowClear' => false,
								'dropdownParent' => new JsExpression("$('#block-pickup')"),
								// 'minimumInputLength' => 2,
								'ajax' => [
									'url' => Url::to(['/checkout/get-delivery']),
									'dataType' => 'json',
									'data' => new JsExpression("function(params){
										return {
											country_id:$('#country').val(),
											city_id:$('#city').val(),
											type:'pickups',
											q:params.term
										};
									}"),
								],
							],
						]);
					?>
				</div>
		<?php
			}
		?>
			
			</div>
	<?php
		}
	?>
		
		</div>
		

		<div class="row justify-content-between">
			<div class="col-auto">
				<p id="delivery_price">
					<?= $delivery_price ?>
				</p>                        
			</div>
			<div class="col-auto">
				<p id="delivery_time">
					<?= $delivery_time ?>
				</p>                        
			</div>
		</div>
		
		<p id="delivery_comment" class="<?= $delivery_comment ? '' : 'd-none' ?>">
			<?= $delivery_comment ?>
		</p>
		
		<p id="delivery_image" class="text-center<?= $delivery_image ? '' : ' d-none' ?>">
			<?= Html::img($delivery_image, [
					'class' => 'img-fluid',
				]);
			?>
		</p>
		
		<div id="address" class="row justify-content-center mt-2">
			<div class="col-12">
				<?= $form
						->field($orderModel, 'address', [
							'inputOptions' => [
								'class' => 'form-control mb-0 px-0',
								'autocomplete' => rand(),
								'placeholder' => ' ',
							],
							'options' => [
								'class' => 'form-group mb-2 position-relative floating-label',
							],
							'template' => '{input}{label}{hint}{error}',
						])
				?>
			</div>
		</div>
		
		<div class="position-relative">
	<?php
		if ($fields){
			foreach ($fields as $field){
	?>
				<div id="<?= $field->name ?>" class="row justify-content-center <?= $field->required == 'yes' ? 'required' : '' ?>"
					<?php if ($field->name != 'postcode'){?>
						style="
							position: absolute;
							top: 0;
							left: 0;
							right: 0;
							opacity: 0;
							z-index: -1;
						"
					<?php } ?>
				>
					<div class="col-12 order-custom-field-<?= $field->id ?>">
					<?php
						if ($widget = $field->type->widget){
							echo $widget::widget([
								'form' => $form,
								'fieldModel' => $field,
								'defaultValue' => $fieldsDefaultValues[$field->name],
							]);
						} else {
							echo $form
									->field($fieldValueModel, 'value['.$field->id.']')
									->label($field->name)
									->textInput([
										'required' => ($field->required == 'yes')
									]);
						}
					?>
					</div>
				</div>
	<?php
			}
		}
	?>
		</div>
		


		<?php if($paymentTypes) { ?>
			<div class="d-none">
				<?= $form->field($orderModel, 'payment_type_id')->dropDownList($paymentTypes) ?>
			</div>
		<?php } ?>
		
		<div id="order_comment" class="row justify-content-center">
			<div class="col-12">
				<?= $form
						->field($orderModel, 'comment', [
							'inputOptions' => [
								'class' => 'form-control mb-0 px-0 px-2',
								'autocomplete' => rand(),
								// 'placeholder' => ' ',
								'rows' => 5,
								'style' => '
									resize: none;
									margin-top: 4px;
									border: 1px solid rgba(0, 0, 0, 0.2);
								',
							],
							'options' => [
								'class' => 'form-group mb-5 position-relative',
							],
							'template' => '{label}{input}{hint}{error}',
						])
						->textArea()
				?>
			</div>
		</div>
		
		<div id="order_total" class="row justify-content-center">
			<div class="col-12">
				<div class="h4">
					<span class="text-bold mr-2">
						<?= Yii::t('front', 'Итого') ?>:
					</span>
					<span id="total">
						<?= $total ?>
					</span>
				</div>
			</div>
		</div>
		
		<div class="row my-5 align-items-center">
			<div class="col-6">
				<?= Html::a(Yii::t('front', 'Назад в корзину'), ['/cart']) ?>
			</div>
			<div id="order_submit" class="col-6 text-center">
				<?= Html::submitButton(Yii::t('front', 'Перейти к оплате'), [
						'class' => 'btn btn-lg btn-primary btn-block py-1 text-uppercase ttfirsneue text-nowrap',
					])
				?>
			</div>
		</div>
            

        <?= Html::hiddenInput('lang_id', $lang_id, [
                'id' => 'lang_id'
            ])
        ?>
        
        <?= $form
                ->field($orderModel, 'id')
                ->hiddenInput()
                ->label(false)
        ?>
        
    <?php ActiveForm::end(); ?>
        
</div>


<?php
    $this->registerJs(
    "
        $.mask.definitions['h'] = '[0-9]';
        
        function setPhoneMask(){
            var mask = $('#country option:selected').attr('data-code') + ' ' + $('#country option:selected').attr('data-phonemask');
            $('#order-phone').mask(mask.replace(/_/g, 'h'), {
                autoclear: false
            });
        }
        
        setPhoneMask();
    ", 
    View::POS_READY);
?>

<?php
    $this->registerJs(
    "
    
        $('#country').change(function(){
            $('#order-phone').val('');
            $('#city').val(null).trigger('change');
            $('#order-shipping_type_id').trigger('change');
            $('[data-field=\"country_id\"]').val($('#country').val());
            $('[data-field=\"country_name\"]').val($('#country option:selected').text());
            setPhoneMask();
        });
        
        $('#city').change(function(){
            $('#order-shipping_type_id').trigger('change');
            $('[data-field=\"city_id\"]').val($('#city').val());
            $('[data-field=\"city_name\"]').val($('#city option:selected').text());
        });
        
        $('#order-shipping_type_id').change(function(){
            clearDeliveryParams();
            toggleAddress();
            if ($(this).val() === '1'){
                $('#delivery').val(null).trigger('change');
            } else if ($(this).val() === '2'){
                $('#pickup').val(null).trigger('change');
            }
        });
        
        $('#delivery').change(function(){
            if ($('#delivery').val()){
                $('[data-field=\"delivery_id\"]').val($('#delivery').val());
                $('[data-field=\"delivery_name\"]').val($('#delivery option:selected').text());
                getDeliveryParams($('#delivery').val());
            }
        });
        
        $('#pickup').change(function(){
            if ($('#pickup').val()){
                $('[data-field=\"delivery_id\"]').val($('#pickup').val());
                $('[data-field=\"delivery_name\"]').val($('#pickup option:selected').text());
                getDeliveryParams($('#pickup').val());
            }
        });
        
        function getDeliveryParams(shippingId){
            $.ajax({
                url: '" . Url::to(['/checkout/get-delivery']) . "',
                method: 'get',
                data: {
                    country_id: $('#country').val(),
                    city_id: $('#city').val(),
                    type: 'details',
                    shipping_id: shippingId
                },
                beforeSend: function(){
                    NProgress.start();
                },
                success: function(response){
                    setDeliveryParams(response);
                },
                error: function(response){
                    console.log(response);
                    toastr.error('" . Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') . "');
                },
                complete: function(){
                    NProgress.done();
                }
            });
        }
        
        function clearDeliveryParams(){
            $('#order_total').hide();
            $('#total').text('');
            $('#delivery_price').text(' ');
            $('#delivery_time').text(' ');
            $('#delivery_comment').html('');
            $('#delivery_comment').addClass('d-none');
            $('#delivery_image img').attr('src', '');
            $('#delivery_image').addClass('d-none');
            $('[data-field=\"delivery_cost\"]').val('');
            $('[data-field=\"delivery_comment\"]').val('');
            $('[data-field=\"postcode\"]').val('');
            $('#order-address').val('');
            $('[data-field=\"delivery_id\"]').val('');
            $('[data-field=\"delivery_name\"]').val('');
        }
        
        function setDeliveryParams(data){
            var params = JSON.parse(data);
            $('#total').text(params.total);
            $('#order_total').show();
            $('#delivery_price').text(params.price);
            $('#delivery_time').text(params.time);
            $('#delivery_comment').html(params.comment);
            $('#delivery_comment').toggleClass('d-none', params.comment === '');
            $('#delivery_image img').attr('src', params.image);
            $('#delivery_image').toggleClass('d-none', params.image === '');
            $('[data-field=\"delivery_cost\"]').val(params.cost);
            $('[data-field=\"delivery_comment\"]').val(params.comment);
        }
        
        function toggleAddress(){
            $('#address, #postcode')
                .toggleClass('d-none', $('#order-shipping_type_id').val() === '2')
                .toggleClass('required', $('#order-shipping_type_id').val() === '1');
        }
        toggleAddress();

        function validateOrderForm(){
            var errors = false;
            
            if ($('#order-form').find('.has-error').length > 0){
                errors = true;
                var message = $('#order-form').find('.has-error').first().find('.help-block').text();
				
                toastr.error(message);
                return false;
            } 
            
            if (errors){
                return false;
            }
            
            $('#order-form').find('.required').each(function(){
                if ($(this).find('input, select, textarea').val() == ''){
                    errors = true;
                    var message = " . (Yii::$app->language == 'ru' ? "'" . Yii::t('front', 'Заполните') . " «' + $(this).find('label').text() + '»';" : "'«' + $(this).find('label').text() + '» ' + '" . Yii::t('front', 'не может быть пустым') . "';") . "
                    toastr.error(message);
                    return false;
                }
            });
            
            if (errors){
                return false;
            }
            
            return true;
        }
        
        $('#order-form')
            .on('afterValidate', function(e){
                return validateOrderForm();
            })
            .on('beforeSubmit', function(e){
                if (validateOrderForm()){
// return true;
                    var orderData = {
                        delivery_method: $('input[data-field=\"delivery_id\"]').val(),
                        delivery_address: {
                            country: $('input[data-field=\"country_id\"]').val(),
                            city: $('input[data-field=\"city_id\"]').val(),
                            city_name: $('input[data-field=\"city_name\"]').val(),
                            post_code: $('input[data-field=\"postcode\"]').val(),
                            address1: $('#order-address').val(),
                            full_name: $('#order-client_name').val()
                        },
                        products: null,
                        name: $('#order-client_name').val(),
                        email: $('#order-email').val(),
                        country_code: $('#country option:selected').data('code'),
                        phone: $('#order-phone').val().replace(/[^+\d]/g, ''),
                        lang_id: " . $lang_id . ",
                        response_lang_id: " . $lang_id . ",
                        success_url: '" . Url::to(['/checkout/success'], true) . "',
                        fail_url: '" . Url::to(['/checkout/error'], true) . "',
                        campaign_id: '" . Yii::$app->request->cookies->getValue('promo') . "',
                        comment: $('#order-comment').val()
                    };
                    
                    $.ajax({
                        url: '" . Url::to(['/checkout/get-products']) . "',
                        method: 'get',
                        async: false,
                        beforeSend: function(){
                            NProgress.start();
                        },
                        success: function(products){
                            orderData.products = JSON.parse(products);
                            $.ajax({
                                url: 'https://api.sessia.com/api/market/" . $store_id . "/ordersAnonymous',
                                method: 'post',
                                data: orderData,
                                async: false,
                                beforeSend: function(){
                                    NProgress.start();
                                    $('[data-field=\"log_request\"]').val(JSON.stringify(orderData));
                                },
                                success: function(response){
                                    $('[data-field=\"log_response\"]').val(JSON.stringify(response));
                                    $('#order-id').val(response.id);
                                    $('[data-field=\"id_order_sessia\"]').val(response.id);
                                    NProgress.start();
                                    $('#order-form')[0].submit();
                                    return true;
                                },
                                error: function(response){
                                    var errors = response.responseJSON;
                                    for (var error in errors){
                                        if (errors[error][0] !== undefined) {
                                            if (Array.isArray(errors[error])) {
                                                toastr.error(errors[error][0]);
                                            } else {
                                                toastr.error(errors[error]);
                                            }
                                        } else {
                                            if (errors[error].message !== undefined) {
                                                toastr.error(errors[error].message);
                                            } else {
                                                for (var msg in errors[error]) {
                                                    if (errors[error][msg][0] !== undefined) {
                                                        toastr.error(errors[error][msg][0]);
                                                    } else {
                                                        toastr.error(errors[error]);
                                                    }
                                                }
                                            }
                                        }
                                        
                                    }
                                    return false;
                                },
                                complete: function(){
                                    NProgress.done();
                                }
                            });
                        },
                        error: function(response){
                            console.log(response);
                            toastr.error('" . Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') . "');
                            return false;
                        },
                        complete: function(){
                            NProgress.done();
                        }
                    });
                }
                
                return false;
            });
    ",
    View::POS_READY);
?>

<?php
    $this->registerJs(
    "
        $(document).on('click', '.next', function(e){
            e.preventDefault();
            var errors = false,
                target = $(this).attr('data-target'),
                parentCollapse = $(this).parents('.collapse');
            
            if ($(parentCollapse).find('.has-error').length > 0){
                errors = true;
                var message = $(parentCollapse).find('.has-error').find('.help-block').text();
                toastr.error(message);
                return false;
            } 
            
            $(parentCollapse).find('.required').each(function(){
                if ($(this).find('input, select, textarea').val() == ''){
                    errors = true;
                    var message = $(this).find('label').text() + ' " . Yii::t('front', 'не может быть пустым') . "';
                    toastr.error(message);
                    return false;
                }
            });
            
            if (!errors){
                $(target).collapse('show');
            }
        })
    ");
?>
