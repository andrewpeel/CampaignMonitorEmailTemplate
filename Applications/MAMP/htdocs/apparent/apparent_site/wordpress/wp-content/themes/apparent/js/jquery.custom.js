/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
 jQuery(document).ready(function($) {

 	/* Javascript - YAY! remove no-js body class ----------------- */
	$('body').removeClass('no-js');


	/* Clone our menu for use later ------------------------------ */
	var mobileMenuClone = $('#primary-menu').clone().attr('id', 'zilla-mobile-menu');


	/* Dropdown menus -------------------------------------------- */
	$('#primary-nav ul').supersubs({
	        minWidth: 12,
	        maxWidth: 27,
	        extraWidth: 0 // set to 1 if lines turn over
	    }).superfish({
    		delay: 200,
    		animation: {opacity:'show', height:'show'},
    		speed: 'fast',
    		autoArrows: false,
    		dropShadows: false
	});


	/* Zilla MobileMenu ----------------------------------------------*/
    function zilla_mobilemenu() {
        var windowWidth = $(window).width();
        
        if( windowWidth <= 992 ) {
            // Show the mobile menu, hide the main menu
            if( !$('#zilla-menu-dropdown').length ) {
                // add our button and cloned menu if they don't already exist
                $('<a id="zilla-menu-dropdown" href="#zilla-mobile-menu"><div class="mobile-logo"></div></a>').prependTo('.header-outer');
                mobileMenuClone.insertAfter('#zilla-menu-dropdown').wrap('<div id="zilla-mobile-menu-wrap" />');
                zilla_menu_listener();
            }
        } else {
            mobileMenuClone.css('display', 'none');
        }
    }
    zilla_mobilemenu();

    // Fire the event listener
    function zilla_menu_listener() {
        $('#zilla-menu-dropdown').click(function(e) {
            if( $('body').hasClass('ie8') ) {

                var mobileMenu = $('#zilla-mobile-menu');

                if( mobileMenu.css('display') === 'block' ) {
                    mobileMenu.css({
                        'display' : 'none'
                    });
                } else {
                    mobileMenu.css({
                        'display' : 'block',
                        'height' : 'auto',
                        'z-index' : 999,
                        'position' : 'absolute' 
                    });
                }

            } else {

                $('#zilla-mobile-menu').stop().slideToggle(500);

            }

            e.preventDefault();
        });
    }

    if( !$('body').hasClass('ie8') ) {    
        window.addEventListener( "orientationchange", function() {
            $('#primary-nav > ul').removeAttr('style');
        }, false );
    }

    
    /* Resized our screens -------------------------------------- */
    $(window).resize(function() {
        zilla_mobilemenu();
    });

    
    /* Scroll to top -------------------------------------------------*/
    function zilla_scroll_to_top() {
        var windowWidth = $(window).width(),
            didScroll = false;

        if( windowWidth > 992 ) {
            var $freeride = $('#back-to-top');

            $freeride.click(function(e) {
                $('body,html').animate({ scrollTop: "0" });
                e.preventDefault();
            })

            $(window).scroll(function() {
                didScroll = true;
            });

            setInterval(function() {
                if( didScroll ) {
                    didScroll = false;

                    if( $(window).scrollTop() > 200 ) {
                        $freeride.css('display', 'block');
                    } else {
                        $freeride.css('display', 'none');
                    }
                }
            }, 250);
        }
    }
    zilla_scroll_to_top();

    /*  Make Video/Audio Responsive - Portfolio ----------------------*/
    function zilla_resize_media() {
        if( $().jPlayer && $('.jp-jplayer').length ){

            $(window).resize(function(){
                $('.jp-jplayer').each(function(){
                    var player = $(this),
                        orig_width = player.attr('data-orig-width'),
                        orig_height = player.attr('data-orig-height'),
                        new_width = orig_width,
                        new_height = orig_height,
                        win_width = $(window).width();

                    // Set responsive width breakpoints here
                    if( win_width <= 992 ) {
                        new_width = 600;
                    }
                    if( win_width <= 600 ) {
                        new_width = 290;
                    }

                    new_height = Math.round((new_width / orig_width) * orig_height);

                    if(player.hasClass('jp-jplayer')) { 
                        player.jPlayer('option', 'size', { width: new_width, height: new_height });
                    }
                    if(player.hasClass('embed-video')) {
                        player.width(new_width).height(new_height);
                    }
                });
            });
            $(window).trigger('resize'); // inital resize
        }
    }
    zilla_resize_media();


	/* FitVids for tiny screens --------------------------------- */
	$('#primary').fitVids();

});