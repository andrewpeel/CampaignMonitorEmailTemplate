		<?php zilla_sidebar_before(); ?>
		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
			
		<?php 
		    zilla_sidebar_start();
			
			/* Widgetised Area */ 
			if( is_page() ) {
				dynamic_sidebar( 'board-4' );
			} else {
				dynamic_sidebar( 'board-5' );
			}
			
			zilla_sidebar_end();
		?>
		
		<!--END #sidebar .aside-->
		</div>
		<?php zilla_sidebar_after(); ?>