<?php get_header(); ?>
		
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			    
			    <?php zilla_post_before(); ?>
				
				<!--BEGIN .hentry -->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php zilla_post_start(); ?>
				    
					<?php 
					$format = get_post_format(); 
					get_template_part( 'content', $format );
					?>
                    
                <?php zilla_post_end(); ?>
            	<!--END .hentry -->
				</div>
				<?php zilla_post_after(); ?>
	
			<?php endwhile; ?>
	
			<!--BEGIN .navigation .page-navigation -->
			<div class="navigation page-navigation">
				<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'zilla')) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'zilla')) ?></div>
			<!--END .navigation .page-navigation -->
			</div>
			
			<?php else :
	
    			if ( is_category() ) { // If this is a category archive
    				printf( __('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'zilla'), single_cat_title('',false));
    			} else if ( is_date() ) { // If this is a date archive
    				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'zilla'));
    			} else if ( is_author() ) { // If this is a category archive
    				$userdata = get_userdatabylogin(get_query_var('author_name'));
    				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'zilla'), $userdata->display_name);
    			} else {
    				echo(__('<h2>No posts found.</h2>', 'zilla'));
    			}
	
			endif; ?>
			
			<!--END #primary .hfeed-->
			</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>