<?php $quote = get_post_meta( $post->ID, '_zilla_quote_quote', true ); ?>

<?php if( is_single() ) { ?>

	<h1 class="entry-title"><?php echo $quote; ?></h1>

<?php } else { ?>

	<h2 class="entry-title"><?php echo $quote; ?></h2>

<?php } ?>

<p class="quote-source"><?php the_title(); ?></p>

<?php if( is_single() ) { ?>
	
	<?php get_template_part( 'content', 'meta-header' ); ?>

	<div class="entry-content">

		<?php 
		the_content( __( 'Continue Reading', 'zilla') ); 
		wp_link_pages(array('before' => '<p class="post-paging"><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
		?>
	</div>

	<?php get_template_part( 'content', 'meta-footer' ); ?>

<?php } else { ?>

	<div class="entry-content">

		<?php 
		the_content( __( 'Continue Reading', 'zilla') ); 
		wp_link_pages(array('before' => '<p class="post-paging"><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
		?>

		<p><a class="entry-permalink" href="<?php  the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>">Comment</a></p>

	</div>

<?php } ?>