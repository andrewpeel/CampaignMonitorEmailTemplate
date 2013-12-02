<?php 
/*
Template Name: Home
*/
?>

<?php get_header(); ?>


        <?php if( get_field('intro') ): ?>

            <?php
                $background_color = 'background-color:' . get_field('background_colour') . ';';
                $text_color = 'color:' . get_field('text_colour') . ';';

            ?>

            <div id="primary" class="hfeed">
                <?php zilla_page_before(); ?>
                <div class="portfolio type-portfolio status-publish hentry home-intro" style="<?php echo $background_color; ?> <?php echo $text_color; ?>">
                    <?php zilla_page_start(); ?>
                    <div class="hentry-inner">
                        <div class="entry-media">
                        </div>
                        <div class="entry-content">
                            <?php the_field('intro') ?>
                        </div>
                    </div>
                    <?php zilla_page_end(); ?>
                </div>
                <?php zilla_page_after(); ?>
            </div>

        <?php endif; ?>


		<?php
		$posts_per_page = 6;
		if(is_page('home')):
			$args = array(
				'post_type' => 'portfolio',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => $posts_per_page
			);
		endif;

		$portfolio_query = new WP_Query($args);

		if( $portfolio_query->have_posts() ) : ?>

			<div id="primary" class="hfeed">
            <?php zilla_page_before(); ?>
                <!--BEGIN .hentry-->
                <div class="hentry-inner">
                    <?php zilla_page_start(); ?>


                    <?php if( get_field('portfolio_heading') ): ?>
                        <!--<h2 class="entry-title"><?php the_field('portfolio_heading'); ?></h2>-->
                    <?php endif;?>

            <?php while( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

			// styles
			$style = 'zilla-' . get_post_meta($post->ID, '_zilla_portfolio_style', true);
			$media_pos = 'zilla-' . get_post_meta($post->ID, '_zilla_portfolio_media_position', true);
			$width = ( $media_pos == 'zilla-media-center' ) ? 940 : 600;

			// project url
			$portfolio_url = get_post_meta($post->ID, '_zilla_portfolio_project_url', true);
			if( !empty($portfolio_url) ) 
				$portfolio_button_copy = get_post_meta($post->ID, '_zilla_portfolio_project_url_copy', true);

			// determine which media to display
			//$portfolio_display_gallery = get_post_meta($post->ID, '_zilla_portfolio_display_gallery', true);
			//$portfolio_display_video = get_post_meta($post->ID, '_zilla_portfolio_display_video', true);
			//$portfolio_display_audio = get_post_meta($post->ID, '_zilla_portfolio_display_audio', true);

			// grab everything else
			//$custom_bg = get_post_meta($post->ID, '_zilla_portfolio_display_background', true);
			//$portfolio_caption = get_post_meta($post->ID, '_zilla_portfolio_caption', true);

		?>



				<div class="portfolio-item" id="post-<?php the_ID(); ?>">


						<!--BEGIN .entry-media -->
						<div class="entry-media">

                            <a href="<?php the_permalink() ?>" target="_blank">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
                            </a>

						<!--END .entry-media -->
						</div>

						<!--BEGIN .entry-content -->
						<div class="entry-content">

							<h4 class="entry-title"><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?></a></h4>

							<?php if( !empty($portfolio_caption) ) 
								echo "<p class='zilla-caption'>" . stripslashes(htmlspecialchars_decode($portfolio_caption)) . "</p>"; ?>

							<?php //the_content(); ?>

							<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                            <?php if( !empty($portfolio_url) ) { ?>
								<?php if ($portfolio_url == "the_permalink()"): ?>
									<!--<a href="<?php the_permalink() ?>" class="more-link"><?php echo $portfolio_button_copy; ?></a>-->
								<?php else: ?>
									<!--<a href="<?php echo esc_url($portfolio_url); ?>" class="more-link" target="_blank"><?php echo $portfolio_button_copy; ?></a>-->
								<?php endif; ?>
                            <?php } ?>

						<!--END .entry-content -->
						</div>
				</div>
					



			<?php endwhile; ?>
            <?php zilla_page_end(); ?>
            <!--END .hentry-->
            </div>
            <?php zilla_page_after(); ?>

			<?php if( is_page('home') && $args['posts_per_page'] > $posts_per_page): ?>
				<div class="hentry-inner more-portfolio">
						<a href="<?php echo home_url('/portfolio/'); ?>" class="more-link">View All Portfolio Items</a>
				</div>
			<?php endif; ?>



			<!--END #primary .hfeed-->
			</div>

    	<?php else: ?>

    	<div id="content">
			<!--BEGIN #post-0-->
			<div id="post-0" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error: No Portfolios Found', 'zilla') ?></h2>
			
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but no portfolios have been created.", "zilla") ?></p>
				<!--END .entry-content-->
				</div>
			
			<!--END #post-0-->
			</div>
    	</div>

	    <?php endif; ?>

<?php get_footer(); ?>

<script>
    (function( $, window, document, undefined ){
        $(window).load(function() {
            $('.portfolio-item').sameHeightAs();
        });

        // if jquery.smartResize.js loaded
        $(window).smartresize(function(event){
            console.log('smartresize');
            $('.portfolio-item').sameHeightAs();
        });
    })( jQuery, window, document );
</script>