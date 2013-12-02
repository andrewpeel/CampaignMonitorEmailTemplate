// All custom JS not relating to theme options goes here

jQuery(document).ready(function($) {

/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/

    /* Grab our vars ---------------------------------------------------------------*/
	var audioOptions = $('#zilla-metabox-post-audio'),
    	audioTrigger = $('#post-format-audio'),
    	videoOptions = $('#zilla-metabox-post-video'),
    	videoTrigger = $('#post-format-video'),
    	galleryOptions = $('#zilla-metabox-post-gallery'),
    	galleryTrigger = $('#post-format-gallery'),
    	linkOptions = $('#zilla-metabox-post-link'),
    	linkTrigger = $('#post-format-link'),
    	quoteOptions = $('#zilla-metabox-post-quote'),
    	quoteTrigger = $('#post-format-quote'),
    	group = $('#post-formats-select input');

    /* Hide and show sections as needed --------------------------------------------*/
    zillaHideAll(null);	

	group.change( function() {
	    $that = $(this);
	    
        zillaHideAll(null);

        if( $that.val() == 'audio' ) {
			audioOptions.css('display', 'block');
		} else if( $that.val() == 'video' ) {
			videoOptions.css('display', 'block');
		} else if( $that.val() == 'gallery' ) {
		    galleryOptions.css('display', 'block');
		} else if( $that.val() == 'link' ) {
		    linkOptions.css('display', 'block');
		} else if( $that.val() == 'quote' ) {
		    quoteOptions.css('display', 'block');
		}

	});

	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');

	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');

    if(galleryTrigger.is(':checked'))
        galleryOptions.css('display', 'block');

    if(linkTrigger.is(':checked'))
        linkOptions.css('display', 'block');

    if(quoteTrigger.is(':checked'))
        quoteOptions.css('display', 'block');

    function zillaHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
    }

/*----------------------------------------------------------------------------------*/
/*	Display portfolio meta boxes as needed
/*----------------------------------------------------------------------------------*/

    /* Grab our vars ---------------------------------------------------------------*/
    var displayGallery = $('#_zilla_portfolio_display_gallery'),
	    displayVideo = $('#_zilla_portfolio_display_video'),
	    displayAudio = $('#_zilla_portfolio_display_audio'),
        displayBackground = $('#_zilla_portfolio_display_background');
        portfolioGallery = $('#zilla-metabox-portfolio-gallery'),
        portfolioVideo = $('#zilla-metabox-portfolio-video'),
        portfolioAudio = $('#zilla-metabox-portfolio-audio');
        portfolioBackground = $('#zilla-metabox-portfolio-background');

    portfolioGallery.css('display', 'none');
	portfolioVideo.css('display', 'none');
	portfolioAudio.css('display', 'none');
    portfolioBackground.css('display', 'none');

    /* Hide and show sections as needed --------------------------------------------*/    
    if( displayGallery.is(':checked') ) portfolioGallery.css('display', 'block');
    if( displayVideo.is(':checked') ) portfolioVideo.css('display', 'block');
    if( displayAudio.is(':checked') ) portfolioAudio.css('display', 'block');
    if( displayBackground.is(':checked') ) portfolioBackground.css('display', 'block');

    displayGallery.click(function(e) {
    	if( $(this).is(':checked') ) portfolioGallery.css('display', 'block');
    	else portfolioGallery.css('display', 'none');
    });
    
	displayVideo.click(function(e) {
    	if( $(this).is(':checked') ) portfolioVideo.css('display', 'block');
    	else portfolioVideo.css('display', 'none');
    });

    displayAudio.click(function(e) {
    	if( $(this).is(':checked') ) portfolioAudio.css('display', 'block');
    	else portfolioAudio.css('display', 'none');
    });

    displayBackground.click(function(e) {
        if( $(this).is(':checked') ) portfolioBackground.css('display', 'block');
        else portfolioBackground.css('display', 'none');
    });
    
});