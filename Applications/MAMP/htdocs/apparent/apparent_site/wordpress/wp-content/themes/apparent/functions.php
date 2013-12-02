<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width (use in conjuction with ".entry-content img" css)
/* ----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 600;

if( !function_exists( 'zilla_content_width' ) ) {
    function zilla_content_width() {
        if( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
            global $content_width;
            $content_width = 940;
        }
    }
}
add_action( 'template_redirect', 'zilla_content_width' );


/*-----------------------------------------------------------------------------------*/
/*	Our theme set up
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_theme_setup' ) ) {
    function zilla_theme_setup() {
        
        /* Load translation domain --------------------------------------------------*/
    	load_theme_textdomain( 'zilla', get_template_directory() . '/languages' );
        
        $locale = get_locale();
    	$locale_file = get_template_directory() . "/languages/$locale.php";
    	if ( is_readable( $locale_file ) )
    		require_once( $locale_file );
    		
    	/* Register WP 3.0+ Menus ---------------------------------------------------*/
 		register_nav_menu( 'primary-menu', __('Primary Menu', 'zilla') );
        register_nav_menu( 'footer-menu', __('Footer Menu', 'zilla') );
   	
    	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
    	add_theme_support( 'post-thumbnails' );
    	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
        add_image_size( 'blog-index', 600, '', true); // blog index/single pages
        add_image_size( 'portfolio-full', 940, '', true); // portfolio full width
        add_image_size( 'portfolio-index', 600, '', true); // portfolio index/single pages
        add_image_size( 'portfolio-thumb', 188, 144, true); // portfolio thumbnails
    	add_image_size( 'portfolio-admin-thumb', 35, 35, true ); // Used in the portfolio edit page
    	
    	/* Add support for post formats ---------------------------------------------*/
        add_theme_support( 
            'post-formats', 
            array(
                'aside',
                'gallery',
                'image',
                'link',
                'quote',
                'video',
                'audio'
            ) 
        );

        add_theme_support( 'automatic-feed-links' );       
    	
    }
}
add_action( 'after_setup_theme', 'zilla_theme_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_sidebars_init' ) ) {

    function zilla_sidebars_init() {
    	register_sidebar(array(
    		'name' => __('Main Sidebar', 'zilla'),
    		'description' => __('Widget area for blog pages.', 'zilla'),
    		'id' => 'sidebar-main',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
        register_sidebar(array(
            'name' => __('Page Sidebar', 'zilla'),
            'description' => __('Widget area for pages.', 'zilla'),
            'id' => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
	}
	
}
add_action( 'widgets_init', 'zilla_sidebars_init' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length (uncomment if required)
/*-----------------------------------------------------------------------------------*/

/*if ( !function_exists( 'zilla_excerpt_length' ) ) {
	function zilla_excerpt_length($length) {
		return 55; 
	}
}
add_filter('excerpt_length', 'zilla_excerpt_length');
*/


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_excerpt_more' ) ) {
	function zilla_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'zilla_excerpt_more');

/*-----------------------------------------------------------------------------------*/
/* Exclude Pages from search
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'zilla_exclude_pages_in_search' ) ) {
    function zilla_exclude_pages_in_search($query) {
        if( $query->is_search ) {
            $query->set('post_type', 'post');
        }
    return $query;
    }
}

add_filter('pre_get_posts','zilla_exclude_pages_in_search');



/*-----------------------------------------------------------------------------------*/
/*	Configure Default Title
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_wp_title' ) ) {
    function zilla_wp_title($title, $sep) {
        if( !zilla_is_third_party_seo() ){
            $title .= get_bloginfo( 'name' );
            
            $site_desc = get_bloginfo( 'description', 'display' );
            if( $site_desc && ( is_home() || is_front_page() ) ) {
                $title = "$title $sep $site_desc";
            } 
            
        }
        return $title;
    }
}
add_filter('wp_title', 'zilla_wp_title', 10, 2);

/*-----------------------------------------------------------------------------------*/
/*	Register and load JS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_scripts' ) ) {
	function zilla_enqueue_scripts() {
	    /* Register our scripts -----------------------------------------------------*/
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.4.8');
		wp_register_script('supersubs', get_template_directory_uri() . '/js/supersubs.js', 'jquery', '0.2');
        wp_register_script('imagesLoaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', 'jquery', '2.0.1');
        wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery', 'imagesLoaded'), '2.1');
        wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', array('jquery'), '2.2.0');
        wp_register_script('fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0');
		wp_register_script('zilla-custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'superfish', 'supersubs', 'fitVids', 'flexslider'), '1.0', TRUE);
		
		/* Enqueue our scripts ------------------------------------------------------*/
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('supersubs');
        wp_enqueue_script('imagesLoaded');
        wp_enqueue_script('jplayer');
        wp_enqueue_script('fitVids');
        wp_enqueue_script('flexslider');
		wp_enqueue_script('zilla-custom');
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 
		if( is_page_template('template-contact.php') ) wp_enqueue_script('validation');

        /* Load main CSS file -------------------------------------------------------*/
        wp_enqueue_style( 'blox-style', get_stylesheet_uri() );
	}
}
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) {
    function zilla_enqueue_admin_scripts() {
        wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
        wp_enqueue_script( 'zilla-admin' );
    }
}
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


/*-----------------------------------------------------------------------------------*/
/*	Include portfolio posts in RSS feed
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'zilla_add_portfolio_to_rss' ) ) {
    function zilla_add_portfolio_to_rss( $request ) {
        if (isset($request['feed']) && !isset($request['post_type']))
            $request['post_type'] = array('post', 'portfolio');

        return $request;
    }
}
add_filter('request', 'zilla_add_portfolio_to_rss');


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_comment' ) ) {
	function zilla_comment($comment, $args, $depth) {
	
        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                
                <?php echo get_avatar($comment,$size='60'); ?>
                
                <div>

                    <div class="comment-author vcard">
                        <cite class="fn"><?php echo get_comment_author_link(); ?></cite><?php if( $isByAuthor ) { ?><span class="author-tag"> <?php _e('(Author)', 'zilla') ?></span><?php } ?>
                    </div>

                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __('%1$s at %2$s', 'zilla'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('Edit', 'zilla'), ' / ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em><br />
                    <?php endif; ?>

                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>

                </div>

            </div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_list_pings' ) ) {
	function zilla_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Output gallery slideshow 
/*
/*  @param int $postid the post id
/*  @param int/string $imagesize the image size 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_gallery' ) ) {
    function zilla_gallery($postid, $imagesize, $slideshow = true, $thumbs = false) { 
        global $is_iphone;

        // if is_iphone do not display thumbs, save data :)
        $thumbs = ( $is_iphone ) ? false : $thumbs;

        if( $slideshow ) {
        ?>
            <script type="text/javascript">
        		jQuery(document).ready(function($){
        			$("#slider-<?php echo $postid; ?>").imagesLoaded( function() {
                        $("#slider-<?php echo $postid; ?>").flexslider({
        				    slideshow: true,
                            controlNav: false,
                            prevText: "<?php echo '&#8250;'; ?>",
                            nextText: "<?php echo '&#8249;'; ?>",
                            namespace: 'zilla-',
                            smoothHeight: true,
                            <?php if( $thumbs && !$is_iphone ) { ?>
                                controlNav: true,
                                manualControls: '#zilla-thumbs-nav-<?php echo $postid; ?> li',
                            <?php } ?>
                            start: function(slider) {
                                slider.container.click(function(e) {
                                    if( !slider.animating ) {
                                        slider.flexAnimate( slider.getTarget('next') );
                                    }
                                });
                            }
                        });
        			});
        		});
        	</script>
        <?php }

        $class = ( $slideshow ) ? ' class="flexslider"' : ' class="stacked"';
    
        $image_ids_raw = get_post_meta($postid, '_zilla_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $temp_id = $postid;
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        $postid = ( isset($temp_id) ) ? $temp_id : $postid;

        if( !empty($attachments) ) {
            echo "<!-- BEGIN #slider-$postid -->\n<div id='slider-$postid'$class>";
            echo '<ul class="slides">';

            foreach( $attachments as $attachment ) {
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? "<div class='slide-caption'>$caption</div>" : '';
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><div>$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' /></div></li>";
            }

            echo '</ul>';
            echo "<!-- END #slider-$postid -->\n</div>";

            if( $thumbs ) {
                // add pagination
                echo '<ul id="zilla-thumbs-nav-' . $postid . '" class="zilla-thumbs-nav">';
                foreach( $attachments as $attachment ) {
                    $src = wp_get_attachment_image_src( $attachment->ID, 'portfolio-thumb');
                    echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' /><span class='preview-icon'></span></li>";
                }
                echo '</ul>';
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/* 
/*  @param int $postid the post id
/*  @param int $width the width of the audio player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_audio' ) ) {
    function zilla_audio($postid, $width = 560, $height = 300) {
	
    	$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
    	$height = get_post_meta($postid, '_zilla_audio_height', TRUE);	
    ?>
    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	
    				if( $().jPlayer ) {
    					$("#jquery-jplayer-audio-<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    <?php if($poster != '') : ?>
    							    poster: "<?php echo $poster; ?>",
    							    <?php endif; ?>
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						<?php if( !empty($poster) ) { ?>
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
            				<?php } ?>
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp-audio-interface-<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3<?php endif; ?>"
    					});
					
    				}
    			});
    		</script>
		
    	    <div id="jp-container-<?php echo $postid; ?>" class="jp-audio">
                <div class="jp-type-single">
                    <div id="jquery-jplayer-audio-<?php echo $postid; ?>" class="jp-jplayer" data-orig-width="<?php echo $width; ?>" data-orig-height="<?php echo $height; ?>"></div>
                    <div id="jp-audio-interface-<?php echo $postid; ?>" class="jp-interface">
                        <ul class="jp-controls">
                            <li><a href="#" class="jp-play" tabindex="1" title="play">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1" title="pause">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Output video
/*
/*  @param int $postid the post id
/*  @param int $width the width of the video player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_video' ) ) {
    function zilla_video($postid, $width = 560, $height = 300) {
	
    	$height = get_post_meta($postid, '_zilla_video_height', true);
    	$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
    	$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
    	$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
	
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
		
    		if( $().jPlayer ) {
    			$("#jquery-jplayer-video-<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					$(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
                        cssClass: "jp-video-normal",
    				    width: "<?php echo $width ?>px",
    				    height: "<?php echo $height . 'px'; ?>"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp-video-container-<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv<?php endif; ?>"
    			});

                $('#jquery-jplayer-video-<?php echo $postid; ?>').bind($.jPlayer.event.playing, function(event) {
                    $(this).add('#jp-video-interface-<?php echo $postid; ?>').hover( function() {
                        $('#jp-video-interface-<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);
                    }, function() {
                        $('#jp-video-interface-<?php echo $postid; ?>').stop().animate({ opacity: 0 }, 400);
                    });
                });
                
                $('#jquery-jplayer-video-<?php echo $postid; ?>').bind($.jPlayer.event.pause, function(event) {
                    $('#jquery-jplayer-video-<?php echo $postid; ?>').add('#jp-video-interface-<?php echo $postid; ?>').unbind('hover');
                    $('#jp-video-interface-<?php echo $postid; ?>').stop().animate({ opacity: 1 }, 400);
                });
    		}
    	});
    </script>

    <div id="jp-video-container-<?php echo $postid; ?>" class="jp-video jp-video-normal">
        <div class="jp-type-single">
            <div id="jquery-jplayer-video-<?php echo $postid; ?>" class="jp-jplayer" data-orig-width="<?php echo $width; ?>" data-orig-height="<?php echo $height; ?>"></div>
            <div class="jp-gui">
            <div id="jp-video-interface-<?php echo $postid; ?>" class="jp-interface">
                <ul class="jp-controls">
                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                </ul>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <?php }
}

/*-----------------------------------------------------------------------------------*/
/*  Output page title
/*
/*  @return string page title
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'zilla_get_page_title' ) ) {
    function zilla_get_page_title() {
        $page_title = '';
        if( is_singular() ) {
            if( is_page() ) {
                $page_title = get_the_title();
            } elseif( is_single() ) {
                $page_title = zilla_get_option('general_default_page_title');
            }
        } else {
            if( is_home() ) {
                $page_title = zilla_get_option('general_default_page_title');
            } elseif( is_archive() ) {
                if( is_category() ) {
                    $page_title = sprintf( __( 'All posts in %s', 'zilla' ), single_cat_title('', false) );
                } elseif( is_tag() ) {
                    $page_title = sprintf( __( 'All posts in %s', 'zilla' ), single_tag_title('', false) );
                } elseif( is_date() ) {
                    if( is_month() ) {
                        $page_title = sprintf( __( 'Archive for %s', 'zilla' ), get_the_time( 'F, Y' ) );
                    } elseif( is_year() ) {
                        $page_title = sprintf( __( 'Archive for %s', 'zilla' ), get_the_time( 'Y' ) );
                    } elseif( is_day() ) {
                        $page_title = sprintf( __('Archive for %s', 'zilla' ), get_the_time( get_option('date_format') ) );
                    } else {
                        $page_title = __('Blog Archives', 'zilla');
                    }
                } elseif( is_author() ) {
                    if(get_query_var('author_name')) {
                        $curauth = get_user_by( 'login', get_query_var('author_name') );
                    } else {
                        $curauth = get_userdata(get_query_var('author'));
                    }
                    $page_title = $curauth->display_name;
                } 
            } elseif( is_search() ) {
                $page_title = sprintf( __( 'Search Results for &#8220;%s&#8221;', 'zilla' ), get_search_query() );
            } 
        }

        return $page_title;
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Output page caption
/*
/*  @return string page caption
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'zilla_get_page_caption' ) ) {
    function zilla_get_page_caption() {
        $page_caption = '';
        if( is_singular() ) {
            $id = get_the_ID();
            if( is_page() ) {
                $page_caption = get_post_meta($id, '_zilla_page_caption', true);
            } elseif( is_single() ) {
                $page_caption = zilla_get_option('general_default_page_caption');
            }
        } else {
            if( is_home() ) {
                $page_caption = zilla_get_option('general_default_page_caption');
            } elseif( is_archive() ) {
                if( is_category() ) {
                    $page_caption = strip_tags(category_description(), '<a><b><em><br>');
                } elseif( is_tag() ) {
                    $page_caption = strip_tags(tag_description(), '<a><b><em><br>');
                }
            }     
        }

        return $page_caption;
    }
}
/**
 * Output styles for a custom backgrounds for portfolios
 *
 * @param int $postid the post ID
 *
 * @return string $content
 */
if( !function_exists( 'zilla_get_custom_background' ) ) {
    function zilla_get_custom_background( $content ) {

        $port_posts = get_posts( array(
            'numberposts' => -1,
            'post_status' => array('publish', 'private'),
            'post_type' => 'portfolio')
        );

        if( empty($port_posts) ) return $content;

        $output = '/* Custom Portfolios */';
        foreach( $port_posts as $post ) {
            $postid = $post->ID;

            $output .= "\n#post-$postid {\n";

            $bg_url = get_post_meta($postid, '_zilla_background_image_url', true);

            if( !empty($bg_url) ) {
                $bg_repeat = get_post_meta($postid, '_zilla_background_repeat', true);
                $bg_position = get_post_meta($postid, '_zilla_background_position', true);

                $output .= "\tbackground-image: url($bg_url);\n";
                $output .= "\tbackground-repeat: $bg_repeat;\n";
                $output .= "\tbackground-position: top $bg_position;\n";
            }

            $bg_color = get_post_meta($postid, '_zilla_background_color', true);
            if( !empty($bg_color) && $bg_color != '#' ) {
                $output .= "\tbackground-color: $bg_color;\n";
            } else {
                $output .= "\tbackground-color: transparent;\n";
            }

            $bg_size = get_post_meta($postid, '_zilla_background_size', true);
            if( isset($bg_size) && $bg_size == 'true' ) {
                $output .= "\tbackground-size: cover;\n";
            }

            $output .= "}\n";
        }

        $content .= $output . "\n";

        return $content;
    }
}
add_action( 'zilla_custom_styles', 'zilla_get_custom_background', 10);


/*-----------------------------------------------------------------------------------*/
/*	Include the framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');

?>