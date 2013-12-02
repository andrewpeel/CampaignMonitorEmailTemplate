<?php

/*-----------------------------------------------------------------------------------
/*	Add Portfolio Post Type
/*---------------------------------------------------------------------------------*/

function zilla_post_type_portfolio() 
{
	$args = array(
		'labels' => zilla_post_type_labels( __('Portfolio', 'zilla') ),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		// Uncomment the folowing line to change the slug
		//'rewrite' => array( 'slug' => 'portfolio-slug' ), 
		'supports' => array('title','editor','thumbnail','custom-fields', 'page-attributes')
	);
	
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'zilla_post_type_portfolio', 1 );

/*-------------------------------------------------------------------------------*/
/* Add Custom Icon for Portfolios 
/*-------------------------------------------------------------------------------*/
function zilla_portfolio_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/includes/images/portfolio-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, 
		#menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-portfolio {
		    background: url(<?php echo get_template_directory_uri(); ?>/includes/images/portfolio-32x32.png) no-repeat 0 -4px;
		}
    </style>
<?php }

add_action( 'admin_head', 'zilla_portfolio_icons' );


/*--------------------------------------------------------------------------------*/
/*  Add Custom Columns for Portfolios 
/*--------------------------------------------------------------------------------*/
function zilla_edit_columns_portfolio($portfolio_columns){  
	$portfolio_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'title' => _x( 'Title', 'column name', 'zilla' ),
		'thumbnail' => __( 'Thumbnail', 'zilla')
	);  
	
	return $portfolio_columns;  
}  
add_filter('manage_edit-portfolio_columns', 'zilla_edit_columns_portfolio');  
  
function zilla_custom_columns_portfolio($portfolio_columns, $post_id){  

	switch ($portfolio_columns) {
	    case 'thumbnail':
	        $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	        
	        if( $thumbnail_id ) {
	            $thumb = wp_get_attachment_image( $thumbnail_id, 'portfolio-admin-thumb', true );
	        }
	        
	        if( isset($thumb) ) {
	            echo $thumb;
	        } else {
	            echo __('None', 'zilla');
	        }
	        
	        break;
	        
		default:
			break;
	}  
}  
add_action('manage_posts_custom_column',  'zilla_custom_columns_portfolio', 10, 2);  


/*-------------------------------------------------------------------------------*/
/*  Enable Sorting of the Portfolio 
/*-------------------------------------------------------------------------------*/

function zilla_create_portfolio_sort_page() {
    $zilla_sort_page = add_submenu_page('edit.php?post_type=portfolio', 'Sort Portfolios', __('Sort Portfolios', 'zilla'), 'edit_posts', basename(__FILE__), 'zilla_portfolio_sort');
    
    add_action('admin_print_styles-' . $zilla_sort_page, 'zilla_print_sort_styles');
    add_action('admin_print_scripts-' . $zilla_sort_page, 'zilla_print_sort_scripts');
}
add_action('admin_menu', 'zilla_create_portfolio_sort_page');


function zilla_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');    
	?>
    <div class="wrap">
        <div id="icon-edit" class="icon32 icon32-posts-portfolio"><br /></div>
        <h2><?php _e('Sort Portfolios', 'zilla'); ?></h2>
        <p><?php _e('Click, drag, re-order. Repeat as neccessary. Portfolio at the top will appear first.', 'zilla'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>        
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
	<?php 
}


function zilla_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}
add_action('wp_ajax_portfolio_sort', 'zilla_save_portfolio_sorted_order');


function zilla_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('zilla_portfolio_sort', get_template_directory_uri() . '/includes/js/zilla_portfolio_sort.js');
}

function zilla_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}

?>