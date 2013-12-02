<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php zilla_post_before(); ?>
				<!--BEGIN .hentry -->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php zilla_post_start(); ?>
				
					<?php
					$format = get_post_format();
					get_template_part( 'content', $format ); 
					?>
                 
                <?php zilla_post_end(); ?>
                <!--END .hentry-->  
				</div>
				<?php zilla_post_after(); ?>

				<?php 
				    zilla_comments_before();
				    comments_template('', true); 
				    zilla_comments_after();
				?>

				<?php endwhile; else: ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
				
					<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h1>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>
			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>