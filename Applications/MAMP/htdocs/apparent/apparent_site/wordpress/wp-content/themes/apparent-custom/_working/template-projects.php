<?php
/*
Template Name: Projects Template
*/
?>

<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php zilla_page_before(); ?>

				<!--BEGIN .hentry-->
				<!-- <div <?php post_class() ?> id="post-<?php the_ID(); ?>">-->
				<?php zilla_page_start(); ?>
				



                    <!--<?php //if ( current_user_can( 'edit_post', $post->ID ) ): ?>              
	                    BEGIN .entry-meta .entry-header
						<div class="entry-meta entry-header">
							<?php //edit_post_link( __('edit', 'zilla'), '<span class="edit-post">[', ']</span>' ); ?>
						END .entry-meta .entry-header
                    </div>
                    <?php //endif; ?>-->



					<!--BEGIN .entry-content
					<div class="entry-content">
						<?php //the_content(__('Read more...', 'zilla')); ?>
						<?php //wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					</div>
					END .entry-content -->




					<?php 
						if ( is_page('mt-penny-coal-project') || is_page('glendon-brook') ): 
							get_template_part( 'content-projects', 'page' ); 
						elseif ( is_page('projects')  || is_page('previous') ):
							get_template_part( 'content-notitle', 'page' ); 
						elseif ( $post->post_parent=="14" || $post->post_parent=="16"):
							get_template_part( 'content', 'page' ); 
						endif;
					?>


                <?php zilla_page_end(); ?>
				<!--END .hentry-->
				<!--</div>-->
				<?php zilla_page_after(); ?>
				
				<?php 
				    zilla_comments_before();
				    comments_template('', true); 
				    zilla_comments_after();
				?>

				<?php endwhile; endif; ?>
			
			<!--END #primary .hfeed-->
			</div>

<?php 
	if ( is_page('mt-penny-coal-project') || $post->post_parent=="14" ):
	 	get_sidebar( 'projects-mt-penny-coal-project' );
	elseif ( is_page('glendon-brook')  || $post->post_parent=="16" ):
	 	get_sidebar( 'projects-glendon-brook' );
	else:
		get_sidebar( 'projects' );
	endif;
?>
<?php get_footer(); ?>