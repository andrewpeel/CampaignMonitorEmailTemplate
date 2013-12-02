<div class="post-thumb">

	<?php 
	$gallery_layout = get_post_meta( $post->ID, '_zilla_gallery_layout', true);
	$slideshow = ( $gallery_layout == 'slideshow' ) ? true : false;
	zilla_gallery( $post->ID, 'blog-index', $slideshow ); 
	?>
	
</div>

<?php if( is_single() ) { ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php get_template_part( 'content' , 'meta-header' ); ?>

<?php } ?>

<!--BEGIN .entry-content -->
<div class="entry-content">
	
	<?php 
		the_content( __('Continue Reading', 'zilla') ); 
		wp_link_pages(array('before' => '<p class="post-paging"><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
	?>

<!--END .entry-content -->
</div>

<?php if( is_single() ) { 

	get_template_part( 'content', 'meta-footer' );

} ?>