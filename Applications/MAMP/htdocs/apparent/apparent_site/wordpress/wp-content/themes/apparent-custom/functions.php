<?php 
/**
 *  Functions and definitions.
 *
**/






/**
 * Shortcodes
 */
include("functions/shortcodes.php");






/**
 * Scripts & Styles
 *
 **/
function apparent_styles_and_scripts(){
    //wp_enqueue_style( 'style-name', get_stylesheet_directory_uri() );

    wp_register_script( 'smartresize', get_stylesheet_directory_uri() . '/lib/js/jquery.smartResize.js', 'jquery', null, true);
    wp_register_script( 'equalheight', get_stylesheet_directory_uri() . '/lib/js/jquery.equalHeight.js', 'jquery', null, true);
    wp_register_script( 'samesizeas', get_stylesheet_directory_uri() . '/lib/js/jquery.sameHeightAs.js', 'jquery', null, true);

    wp_enqueue_script( 'smartresize', get_stylesheet_directory_uri() . '/lib/js/jquery.smartResize.js', null, null, true );
    wp_enqueue_script( 'equalheight', get_stylesheet_directory_uri() . '/lib/js/jquery.equalHeight.js', null, null, true );
    wp_enqueue_script( 'samesizeas', get_stylesheet_directory_uri() . '/lib/js/jquery.sameHeightAs.js', null, null, true );


}
add_action( 'wp_enqueue_scripts', 'apparent_styles_and_scripts' );



/**
 * Advanced Custom Fields (ACF): Location Field 
 *
**/
function apparent_acf_register_fields() {	

    include_once(WP_PLUGIN_DIR . '/acf-location-field/acf-location.php');
}
add_action('acf/register_fields', 'apparent_acf_register_fields');





if ( ! function_exists('footer_sidebar') ) {

// Register Sidebar
    function footer_sidebar()  {

        $args = array(
            'id'            => 'footer_sidebar',
            'name'          => __( 'Footer', 'footer_sidebar' ),
            'description'   => __( 'Show the widget in the Footer', 'footer_sidebar' ),
            'before_title'  => '',
            'after_title'   => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
        );
        register_sidebar( $args );

    }

// Hook into the 'widgets_init' action
    add_action( 'widgets_init', 'footer_sidebar' );

}




/**
 * Register Sidebars
 */
// if ( !function_exists( 'apparent_widgets_init' ) ) {
// 	function apparent_widgets_init() {

// 		register_sidebar(array(
// 	        'name' => __('Front 1', 'zilla'),
// 	        'description' => __('', 'zilla'),
// 	        'id' => 'front-4',
// 	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	        'after_widget' => '</div>',
// 	        'before_title' => '<h3 class="widget-title">',
// 	        'after_title' => '</h3>',
// 	    ));




// 	}
// }
// add_action( 'widgets_init', 'apparent_widgets_init' );





/**
 * Speed up ThemeZilla admin
 */
/*if ( !function_exists( 'zilla_get_theme_changelog' ) ) {
	function zilla_get_theme_changelog(){
		return false;
	}
}*/






/**
* The Slug
**/
if ( !function_exists( 'the_slug' ) ) {
	function the_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}
}






/**
* Debug: Show current template in header
**/
if ( !function_exists( 'show_template' ) ) {
	function show_template() {   
		global $template;
		print_r($template);
	}
}
//add_action('wp_head', 'show_template'); 





/**
* Header Background 
* 
* Requires Advanced Custom Fields ACF
* Custom Field 'background-image'
* 
* Usage
* Apply the 'background-image' to the page, and child-page as full-width
* 
**/
// if ( !function_exists( 'peeela_header_bkgd' ) ) {
// 	function peeela_header_bkgd($post){
// 		if (!is_page('home')) :
// 			if ( get_field('background-image', $post->ID) || get_field('background-image', $post->post_parent) ): 
// 				if( get_field('background-image', $post->ID) ):
// 					$url = get_field('background-image', $post->ID);
// 				elseif( get_field('background-image', $post->post_parent) ):
// 					$url = get_field('background-image', $post->post_parent);
// 				endif;
// 				echo "<style>.bkgd-".the_slug()." { background-image: url('".$url."'); }</style>";
// 				echo '<div id="header-bkgd" class="bkgd-header bkgd-'.the_slug().' post-id-'.$post->ID.' parent-id-'.$post->post_parent.'">';
// 			endif;
// 		endif;
// 	}
// } 







/**
* 360° Panoramic Viewer
* 
* Requires
* jquery.js
* jquery.mousewheel.min.js
* jquery.panorama360.js
* panorama360.css
* panorama.home.css
* 
* Usage
* peeela_panorama() in the theme 'header.php'
*
**/
// if ( !function_exists( 'panorama_scripts' ) && !function_exists( 'panorama_html' )  && !function_exists( 'peeela_panorama' )  ) {

// 	function panorama_scripts() {
// 		if (is_page('home')) :
// 		    wp_register_script( 'jquery.mousewheel', get_stylesheet_directory_uri().'/lib/360-panoramic-viewer/js/jquery.mousewheel.min.js', 'jquery', null, true );
// 		    wp_register_script( 'jquery.panorama360', get_stylesheet_directory_uri().'/lib/360-panoramic-viewer/js/jquery.panorama360.js', 'jquery', null, true );
// 		    wp_register_script( 'panorama.home', get_stylesheet_directory_uri().'/lib/360-panoramic-viewer/js/panorama.home.js', 'jquery.panorama360', null, true );

// 		    wp_enqueue_script( 'jquery.mousewheel');
// 		    wp_enqueue_script( 'jquery.panorama360');
// 		    wp_enqueue_script( 'panorama.home');

// 		    wp_enqueue_style( 'panorama360', get_stylesheet_directory_uri() . '/lib/360-panoramic-viewer/css/panorama360.css', null, false, 'screen' );
// 		    wp_enqueue_style( 'panorama.home', get_stylesheet_directory_uri() . '/lib/360-panoramic-viewer/css/panorama.home.css', null, false, 'screen' );
// 	    endif;
// 	}
// 	add_action( 'wp_enqueue_scripts', 'panorama_scripts' ); 

// 	function panorama_html(){
// 		$panorama_dir = get_stylesheet_directory_uri() . '/lib/360-panoramic-viewer/';
// 		$panorama_src = "Mt-Penny-Looking-North-H600-Q15.jpg"; 
// 		$panorama_alt = "Mt Penny"; 
// 		$panorama_title = "Mt Penny<br/>Coal Project";
// 		$panorama_data_width = "5101";
// 		$panorama_data_height = "600";
// 		$panorama_img = $panorama_dir.'/images/'.$panorama_src;
// 		$html = '<div class="panorama">';
// 		$html .= '<div class="panorama-title clearfix hfeed full-width"><h1 class="panorama-title-h1">'.$panorama_title.'</h1></div>';
// 		$html .= '<div class="preloader"></div>';
// 		$html .= '<div class="panorama-view">';
// 		$html .= '<div class="panorama-container"><img src="'.$panorama_img.'" data-width="'.$panorama_data_width.'" data-height="'.$panorama_data_height.'" alt="'.$panorama_alt.'" /></div>';
// 		$html .= '</div>';
// 		$html .= '</div>';
// 		return $html;
// 	}

// 	function peeela_panorama(){
// 		if (is_page('home')) :
// 			echo panorama_html();
// 		endif;
// 	}

// }

	



?>