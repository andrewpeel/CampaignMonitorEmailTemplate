<?php /* if the post has a WP 2.9+ Thumbnail */
if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && !is_single() ) { ?>
<div class="post-thumb">

	<?php if( !is_single() ) { ?><a title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php } ?>
		<?php the_post_thumbnail('blog-index'); /* post thumbnail settings configured in functions.php */ ?>
	<?php if( !is_single() ) { ?></a><?php } ?>
	
</div>
<p><?php the_title(); ?> - <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"> Comment</a></p>
<?php } ?>

<?php if( is_single() ) { ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php get_template_part( 'content' , 'meta-header' ); ?>

	<!--BEGIN .entry-content -->
	<div class="entry-content">
		
		<?php 
			the_content( __('Continue Reading', 'zilla') ); 
			wp_link_pages(array('before' => '<p class="post-paging"><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
		?>
		
	<!--END .entry-content -->
	</div>

	<?php get_template_part( 'content', 'meta-footer' ); ?>

<?php } elseif( !(has_post_thumbnail()) && !is_single() ) { ?> 

	<!--BEGIN .entry-content -->
	<div class="entry-content">
		
		<?php 
			the_content( __('Continue Reading', 'zilla') ); 
			wp_link_pages(array('before' => '<p class="post-paging"><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
		?>
		
	<!--END .entry-content -->
	</div>
	<br/>
	<p><?php the_title(); ?> - <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"> Comment</a></p>

<?php } ?>
