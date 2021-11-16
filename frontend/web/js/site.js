
new WOW({
        mobile: false
    }).init();

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


// меню
prevScroll = 0;
$(window).scroll(function(){
    var offset = $(window).scrollTop();
// console.log(offset);
    $('#nav').toggleClass('hidden', offset > 100 && offset > prevScroll);
    prevScroll = offset;
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
		navText: ['<div class="goto_prev"></div', '<div class="goto_next"></div>'],
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


// анимация волны кнопки
$('.btn-nrk').on('click',function(){
    $(this).addClass('click');
});
$('.btn-nrk').on('webkitAnimationEnd',function(){
    $(this).removeClass('click');
});



$('body').mousemove(function(e){
    $('.cover, .horizontal-parallax').each(function(){
        var images = $(this).find('img');
        $(images).each(function(key, el){
            $(this).css('marginLeft', Math.round(e.pageX * ($(this).hasClass('horizontal-parallax-reverse') ? -1 : 1) / (20 + (images.length - key)*30)));
        });
    });
    // $('#cover, .horizontal-parallax').each(function(){
        // $($(this).find('img').get().reverse()).each(function(key, el){
            // $(this).css('marginLeft', e.pageX * -1 / (20 + key*30));
        // });
    // });
});


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



function showVoteResults(data){
	console.log(data);
	var results = data;
	$('.vote-results').html('<dl class="dl-horizontal"></dl>');
	for (var i = 0; i < results.length; i++){
		$('.vote-results .dl-horizontal').append(
			'<dt>' + results[i].name + '</dt>' + 
			'<dd>' + 
				'<div class="progress mt-1 bg-transparent">' + 
					'<div class="vote-result-progress-' + i + ' progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="' + results[i].percent + '" aria-valuemin="0" aria-valuemax="100" style="width:0%"><strong>' + results[i].percent + '%</strong></div>' + 
				'</div>' + 
			'</dd>'
		);
		$('.vote-result-progress-' + i).animate({
			'width': results[i].percent + '%'
		}, {
			duration: 500,
			easing: 'linear'
		});
	}
}



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