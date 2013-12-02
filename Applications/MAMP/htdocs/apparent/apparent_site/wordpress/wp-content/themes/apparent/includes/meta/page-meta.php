<?php

/**
 * Create the Post meta boxes
 */
 
add_action('add_meta_boxes', 'zilla_metabox_pages');
function zilla_metabox_pages(){
    
	/* Create a gallery metabox -----------------------------------------------------*/
    $meta_box = array(
		'id' => 'zilla-metabox-page',
		'title' =>  __('Page Settings', 'zilla'),
		'description' => __('Set up your page.', 'zilla'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Page Caption', 'zilla'),
					'desc' => __('Enter a custom page caption', 'zilla'),
					'id' => '_zilla_page_caption',
					'type' => 'text',
					'std' => '',
				)
		)
	);
    zilla_add_meta_box( $meta_box );
}