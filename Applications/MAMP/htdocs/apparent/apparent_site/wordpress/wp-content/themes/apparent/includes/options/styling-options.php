<?php

/**
 * Create the Styling Options section
 */
add_action('admin_init', 'zilla_styling_options');
function zilla_styling_options(){
	
	$styling_options['description'] = __('Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your overall layout and inserting any custom CSS necessary.', 'zilla');
	
	$styling_options[] = array('title' => __('Accent Color', 'zilla'),
	                           'desc' => __('Change this color to specify the "accent" color for your site.', 'zilla'),
	                           'type' => 'color',
	                           'id' => 'style_accent_color',
	                           'val' => '#f26c4f');

	$styling_options[] = array('title' => __('Main Layout', 'zilla'),
                               'desc' => __('Select main content and sidebar alignment.', 'zilla'),
                               'type' => 'radio',
                               'id' => 'style_main_layout',
                               'val' => 'layout-2cr',
                               'options' => array(
                                   'layout-2cr' => __('2 Columns (right)', 'zilla'),
                                   'layout-2cl' => __('2 Columns (left)', 'zilla')
                               ));

    $styling_options[] = array('title' => __('Custom CSS', 'zilla'),
                               'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'zilla'),
                               'type' => 'textarea',
                               'id' => 'style_custom_css');
                                
    zilla_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/**
 * Output main layout
 */
function zilla_style_main_layout($classes) {
	$zilla_values = get_option( 'zilla_framework_values' );
	$layout = 'layout-2cr';
	if( array_key_exists( 'style_main_layout', $zilla_values ) && $zilla_values['style_main_layout'] != '' ){
		$layout = $zilla_values['style_main_layout'];
	}
	$classes[] = $layout;
	return $classes;
}
add_filter( 'body_class', 'zilla_style_main_layout' );


/**
 * Output the custom CSS
 */
function zilla_custom_css($content) {
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_custom_css', $zilla_values ) && $zilla_values['style_custom_css'] != '' ){
    	$content .= '/* Custom CSS */' . "\n";
        $content .= stripslashes($zilla_values['style_custom_css']);
        $content .= "\n\n";
    }
    return $content;
    
}
add_action( 'zilla_custom_styles', 'zilla_custom_css' );

/**
 * Output the Accent Color
 */

function zilla_accent_color( $content ) {
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_accent_color', $zilla_values ) && $zilla_values['style_accent_color'] != '') {
        $color = $zilla_values['style_accent_color'];

        if( !empty($color) && $color != '#f26c4f' ) {
            $content .= "a,\n.entry-title a:hover,\n#logo a:hover,\n.slide-caption a:hover,\n.link-source a:hover,\n.comment-author a:hover,\n#commentform .required,\n.widget ul a:hover { color: $color; }\n\n";

            $content .= ".zilla-direction-nav a:hover,\n.jp-play:hover,\n.jp-pause:hover,\n.jp-mute:hover,\n.jp-unmute:hover,\n.jp-play-bar,\n.jp-volume-bar-value,\n.jp-toggles a:hover { background-color: $color; }\n\n";

            $content .= ".more-link:hover,\nbutton:hover,\n#submit:hover,\n.gform_next_button:hover,\n.gform_previous_button:hover,\n.gform_button:hover,\nmore-link:hover,\n.zilla-dark .more-link:hover,\n.twitter-link:hover,\n.flickr_badge_image a,\n.zilla-dribbble-shots a { background: $color; }\n\n";

            $content .= ".format-link .entry-title a:hover { border-bottom: 2px solid $color; }\n\n";
        }
    }

    return $content;
}
add_action( 'zilla_custom_styles', 'zilla_accent_color');

?>