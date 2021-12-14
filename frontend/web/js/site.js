
lazyload();
$(document).on('pjax:end', function(){
	lazyload();
});

// индикатор загрузки
NProgress.start();
$(document).on('pjax:start', function(){
    NProgress.start();
});
$(document).on('pjax:end', function(){
    NProgress.done();
});
$('form').on('beforeSubmit', function(){
    NProgress.done();
});
$(window).on('beforeunload', function(){
    NProgress.start();
});
$(window).on('load', function(){
    NProgress.done();
});
$(document).on('click', '.loading', function(){
    NProgress.done();
});


$.mask.definitions['_'] = "[0-9]";


// уведомления
toastr.options = {
	tapToDismiss: true,
	positionClass: 'toast-bottom-right',
	newestOnTop: false,
    preventDuplicates: true,
    escapeHtml: false,
};


// модальные окна
$(document).on('click', '*[data-toggle="lightbox"], .lightbox', function(e){
	e.preventDefault();
	$(this).ekkoLightbox({
		alwaysShowClose: true,
	});
});


// $('body').css({'background': '#000'});
// меню
prevScroll = 0;

$(window).scroll(function(){
	mainMenuStyle();
});

mainMenuStyle = function(){
    var offset = $(window).scrollTop();

    $('#nav')
		.toggleClass('hidden', offset > 20 && offset > prevScroll)
		.toggleClass('shadow-sm', offset > 20)
		.toggleClass('mt-0_5 mt-lg-1_5 bg-transparent', offset < 20);
		
	if ($('#nav').is('.dark')){
		if (offset > $(window).height()/2){
			$('#nav')
				.removeClass('navbar-dark bg-transparent')
				.addClass('navbar-light bg-white shadow-sm');
		} else {
			$('#nav')
				.removeClass('navbar-light bg-white shadow-sm')
				.addClass('navbar-dark bg-transparent');
		}
	}
    prevScroll = offset;
}

$(document).ready(function(){
	mainMenuStyle();
});


// popover
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'focus',
        container: 'body',
        content: function(){
            if ($(this).is('[data-element]')){
                return $($(this).attr('data-element')).html();
            } else {
                return $(this).attr('data-content');
            }
        },
	});
    // }).on('shown.bs.popover', function(){
        // generateOwlCarousel();
    // });
});


$(document).ready(function(){
	$('input[name="shipping_type_switcher"]').click(function(){
		$(this).tab('show');
		$(this).removeClass('active');
		$('#order-shipping_type_id').val($(this).val()).trigger('change');
	});
});



// формы

$(document)
    .on('beforeValidate', 'form.disabling', function(){
        $(this).attr('disabled', 'disabled');
    })
    .on('afterValidate', 'form.disabling', function(){
        $(this).removeAttr('disabled');
    })
    .on('beforeSubmit', 'form.disabling', function(){
        $(this).attr('disabled', 'disabled');
    });
    
$(document).on('submit', 'form.disabled', function(e){
    e.preventDefault();
    return false;
});

$(document).on('submit', 'form.ajax', function(e){
	e.preventDefault();
	var $form = $(this),
        url = $form.attr('action'),
        type = $form.attr('method'),
        data = $form.serialize();
    sendAjaxData($form, url, type, data, true);
});

$(document).on('click', 'a.ajax, button.ajax', function(e){
    e.preventDefault();
    var $link = $(this),
        url = $link.attr('data-target') ? $link.attr('data-target') : $link.attr('data-remote') ? $link.attr('data-remote') : $link.attr('href');
        if (url[0] === '/') url = location.protocol + '//' + location.hostname + url;
    sendAjaxData($link, url);
});

function sendAjaxData($element, action, method = 'get', params = [], isForm = false){
    NProgress.start();
	$.ajax({
		url: action,
		type: method,
        data: params,
		success: function(data){
			switch (data.status){
				case 'warning': toastr.warning(data.message); break;
				case 'danger': toastr.error(data.message); break;
				case 'error': toastr.error(data.message); break;
				case 'success': toastr.success(data.message); break;
				case 'info': toastr.info(data.message); break;
			}
			if (data.script && data.script != ''){
				$('body').append('<script type="text/javascript" class="serverscript">' + data.script + ' $(".serverscript").remove();</script>');
			}
			if (data.status == 'success'){
				$element.find('input[type="text"]').val('');
				$('.modal').modal('hide');
			}
		},
		error: function(data){
            toastr.error('Ошибка! Попробуйте еще раз чуть позже');
            console.log(data);
            return false;
		},
        complete: function(){
            NProgress.done();
        }
	});
}


// OWL

function owlCarouselInit(item){
	var itemCount = ($(item).attr('data-items')) ? $(item).attr('data-items').split('-') : [1,1,1,1,1,1],
		owlAutoPlay = ($(item).attr('data-autoplay') == 'true' || $(item).hasClass('owl-autoplay')) ? true : false,
		owlAutoPlayTimeout = ($(item).attr('data-speed')) ? parseFloat($(item).attr('data-speed')) : 5000,
		owlAutoplayHoverPause = ($(item).attr('data-hoverstop') == 'true' || $(item).hasClass('owl-hoverstop')) ? true : false,
		owlAutoHeight = ($(item).attr('data-autoheight') == 'true' || $(item).hasClass('owl-autoheight')) ? true : false,
		owlAutoWidth = ($(item).attr('data-autowidth') == 'true' || $(item).hasClass('owl-autowidth')) ? true : false,
		owlNav = ($(item).attr('data-nav') == 'true' || $(item).hasClass('owl-nav')) ? true : false,
		owlDots = ($(item).attr('data-dots') == 'true' || $(item).hasClass('owl-dots')) ? true : false,
		owlLazyLoad = ($(item).attr('data-lazy') == 'true' || $(item).hasClass('owl-lazyload')) ? true : false,
		owlAnimateIn = ($(item).attr('data-animatein')) ? $(item).attr('data-animatein') : false,
		owlAnimateOut = ($(item).attr('data-animateout')) ? $(item).attr('data-animateout') : false,
		owlCenter = ($(item).attr('data-center') == 'true' || $(item).hasClass('owl-center')) ? true : false,
		owlLoop = ($(item).attr('data-loop') == 'true' || $(item).hasClass('owl-loop')) ? true : false,
		owlMargin = ($(item).attr('data-margin')) ? parseFloat($(item).attr('data-margin')) : false,
		owlRandom = ($(item).attr('data-random') == 'true' || $(item).hasClass('owl-random')) ? true : false;
        if ($(item).hasClass('owl-fade')){
            owlAnimateIn = 'fadeIn';
            owlAnimateOut = 'fadeOut';
        }
        if ($(item).hasClass('owl-autoplay')){
            owlAutoPlayTimeout = 3000;
        }
	$(item).owlCarousel({
		items: parseFloat(itemCount[0]),
		responsive:{
			0:{
				items: parseFloat(itemCount[0])
			},
			480:{
				items: parseFloat(itemCount[1])
			},
			768:{
				items: parseFloat(itemCount[2])
			},
			992:{
				items: parseFloat(itemCount[3])
			},
			1200:{
				items: parseFloat(itemCount[4])
			},
			1440:{
				items: parseFloat(itemCount[5])
			}
		},
		responsiveBaseElement: 'body',
		autoplay: owlAutoPlay,
		autoplayTimeout: owlAutoPlayTimeout,
		autoplayHoverPause: owlAutoplayHoverPause,
		autoHeight: owlAutoHeight,
		autoWidth: owlAutoWidth,
		nav: owlNav,
		dots: owlDots,
		lazyLoad: owlLazyLoad,
		animateIn: owlAnimateIn,
		animateOut: owlAnimateOut,
		center: owlCenter,
		loop: owlLoop,
		margin: owlMargin,
		checkVisibility: false,
		navText: [
			'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>', 
			'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>'
		],
		onInitialize: function(element){
			if (owlRandom === true){
				$(item).children().sort(function(){
					return Math.round(Math.random()) - 0.5;
				}).each(function(){
					$(this).appendTo($(item));
				});
			}
            imageZoom();
		},
        onDragged: function(){
            imageZoom();
        },
        onChanged: function(event){
            $(item).attr('data-item', event.item.index ? event.item.index-1 : event.item.index);
            imageZoom();
        },
	});
}

function generateOwlCarousel(){
	$('.owl-carousel').each(function(){
		owlCarouselInit($(this));
	});
}

$(document).ready(function(){
    generateOwlCarousel();
});


// меню
$(document).on('click.bs.dropdown.data-api', '.dropdown-menu', function(e){
    e.stopPropagation();
});


// зум изображений товаров
function imageZoom(){
	$('.zoom').each(function(){
		$(this).zoom({
			url: $(this).data('url') ? $(this).data('url') : $(this).parent('img').attr('src'),
			magnify: 3,
			touch: false,
		});
	});	 
}
$(document).ready(function(){
	imageZoom();
	Fancybox.bind('.fancybox', {
		Image: {
			fit: 'cover',
			Panzoom: {
				baseScale: 1,
				maxScale: 1,
			},
		},
	});
});


// выбор размера
$(document).on('click', '.dropdown-change-select', function(){
	var $element = $(this).parents('.dropdown').find('button[data-toggle="dropdown"]'),
		id = $(this).data('id'),
		val = $(this).data('value');
		txt = $(this).text();
		
	$('select[data-id="' + id + '"]')
		.val(val)
		.trigger('change');
		
	$element
		.text(txt)
		.attr('aria-expanded', false)
		.addClass('changed');
		
	$element.dropdown('hide');
});



// wishlist
wishlistCheck = function(){
	var $btn = $('.btn-wishlist');
	$.get('/' + $btn.data('lang') + '/wishlist/check', {
		'product_id': $btn.data('product'),
		'size': $btn.data('size')
	}, function(data){
		$btn.replaceWith(data);
	});
}
$(document).on('click', '.btn-wishlist', function(){
	$.get('/' + $(this).data('lang') + '/wishlist/' + $(this).data('action'), {
		'product_id': $(this).data('product'),
		'size': $(this).data('size')
	}, function(){
		wishlistCheck();
	});
});


// Яндекс Ecommerce
ymDetail = function(id, name, price, variant, currency){
	window.dataLayer.push({
		'ecommerce': {
			'currencyCode': currency,
			'detail': {
				'products': [
					{
						'id': id,
						'name': name,
						'price': price,
						'variant': variant,
					}
				]
			}
		}
	});
	ym(85187701, 'reachGoal', 'ViewContent');
}

ymAdd = function(id, name, price, variant, currency){
	window.dataLayer.push({
		'ecommerce': {
			'currencyCode': currency,
			'add': {
				'products': [
					{
						'id': id,
						'name': name,
						'quantity': 1,
						'price': price,
						'variant': variant,
					}
				]
			}
		}
	});
	ym(85187701, 'reachGoal', 'AddToCard');
}

ymRemove = function(id, name, price, variant, currency){
	window.dataLayer.push({
		'ecommerce': {
			'currencyCode': currency,
			'remove': {
				'products': [
					{
						'id': id,
						'name': name,
						'quantity': 1,
						'price': price,
						'variant': variant,
					}
				]
			}
		}
	});
	ym(85187701, 'reachGoal', 'RemoveToCard');
}

ymPurchase = function(id, products, currency){
	window.dataLayer.push({
		'ecommerce': {
			'currencyCode': currency,
			'purchase': {
				'actionField': {
					'id': id,
				},
				'products': JSON.parse(products)
			}
		}
	});
	ym(85187701, 'reachGoal', 'Purchase');
}


// Facebook pixel
fbqViewContent = function(id, name, price, variant, currency){
	fbq('track', 'ViewContent',
		{
			value: price,
			currency: currency,
			contents: [
				{
					id: id,
					quantity: 1,
					name: name,
					price: price,
					variant: variant,
				},
			],
			content_type: 'product',
		}
	);
	
	$.get('/facebook-conversions', {
		data: JSON.stringify({
			event_name: 'ViewContent',
			currency: currency,
			value: price,
			contents: [
				{
					id: id,
					quantity: 1,
					price: price,
				},
			],
			content_type: 'product',
			name: name,
			variant: variant
		})
	});
}

fbqAddToCart = function(id, name, price, variant, currency){
	fbq('track', 'AddToCart',
		{
			value: price,
			currency: currency,
			contents: [
				{
					id: id,
					quantity: 1,
					name: name,
					price: price,
					variant: variant,
				},
			],
			content_type: 'product',
		}
	);
	
	$.get('/facebook-conversions', {
		data: JSON.stringify({
			event_name: 'AddToCart',
			currency: currency,
			value: price,
			contents: [
				{
					id: id,
					quantity: 1,
					price: price,
				},
			],
			content_type: 'product',
			name: name,
			variant: variant
		})
	});
}

fbqPurchase = function(products, sum, currency){
	fbq('track', 'Purchase',
		{
			value: sum,
			currency: currency,
			contents: JSON.parse(products),
			content_type: 'product',
		}
	);
	
	$.get('/facebook-conversions', {
		data: JSON.stringify({
			event_name: 'Purchase',
			currency: currency,
			value: sum,
			contents: JSON.parse(products),
			content_type: 'product',
			name: '',
			variant: ''
		})
	});
}


$(document).on('click', '.cart-change-count', function(){
	var plus = $(this).hasClass('plus'),
		$row = $(this).parents('.cart-product'),
		id = $row.attr('data-id'),
		name = $row.attr('data-name'),
		price = $row.attr('data-price'),
		variant = $row.find('.cart-product-variant').text(),
		currency = $row.attr('data-currency');
		
	if (plus){
		ymAdd(id, name, price, variant, currency);
		fbqAddToCart(id, name, price, variant, currency);
	} else {
		ymRemove(id, name, price, variant, currency);
	}
});