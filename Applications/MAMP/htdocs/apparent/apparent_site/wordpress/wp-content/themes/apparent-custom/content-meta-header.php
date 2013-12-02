<!--BEGIN .entry-meta .entry-header-->
<div class="entry-meta entry-header">
	<span class="published"><?php the_time( get_option('date_format') ); ?></span>
	<span class="meta-sep"> / </span>

	<?php 
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
	?>

	<!--<span class="meta-sep"> / </span>
	<span class="comment-count"><?php comments_popup_link(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>-->
	<?php if( !is_single() ) { ?>
		<span class="meta-sep"> / </span>
		<span class="entry-categories"><?php _e('', 'zilla') ?> <?php the_category(', ') ?></span>
	<?php } ?>
	<?php edit_post_link( __('Edit', 'zilla'), ' / <span class="edit-post">', '</span>' ); ?>
<!--END .entry-meta entry-header -->
</div>