<?php 

/**
 * Create the Post Options section
 */
add_action('admin_init', 'zilla_post_options');
function zilla_post_options(){
	$post_options['description'] = __('Here you can configure how you would like your posts to function. THIS NEEDS TO BE FINISHED/EDITED WITH A RELEVANT DESC BEFORE THEME LAUNCH.', 'zilla');

    $post_options[] = array('title' => __('Show Featured Image', 'zilla'),
                            'desc' => __('Check this to show the featured image at the beginning of the post.', 'zilla'),
                            'type' => 'checkbox',
                            'id' => 'post_show_featured_image');
                            
    $post_options[] = array('title' => __('Show Author Bios', 'zilla'),
                            'desc' => __('Check this to show an author bio panel on each post page.', 'zilla'),
                            'type' => 'checkbox',
                            'id' => 'post_show_author_bios');
                                
    zilla_add_framework_page( 'Post Options', $post_options, 15 );
}

?>