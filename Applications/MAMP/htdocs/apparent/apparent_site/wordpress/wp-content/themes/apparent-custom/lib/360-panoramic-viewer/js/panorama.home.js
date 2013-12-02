(function( $, window, document, undefined ){ 
	$('.panorama-view').panorama360({ 
		is360 : true, 
		sliding_direction : 1, 
		sliding_interval: 30 
	}); 

	$('.panorama-title').mouseenter(function(){ 
		$(this).addClass('panorama-title-hover').find('.panorama-title-h1').addClass('panorama-title-h1-hover'); })
	.mouseleave(function(){ 
		$(this).removeClass('panorama-title-hover').find('.panorama-title-h1').removeClass('panorama-title-h1-hover'); 
	}); 

	$('.panorama-title').click(function(){ 
		window.location.href = 'http://cascadecoal.weareapparent.com.au/site/projects/mt-penny-coal-project'; 
	}); 
})( jQuery, window, document );