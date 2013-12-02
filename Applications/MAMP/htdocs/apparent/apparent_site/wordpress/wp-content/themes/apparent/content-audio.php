<div class="post-thumb">

	<?php zilla_audio($post->ID, 600); ?>

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