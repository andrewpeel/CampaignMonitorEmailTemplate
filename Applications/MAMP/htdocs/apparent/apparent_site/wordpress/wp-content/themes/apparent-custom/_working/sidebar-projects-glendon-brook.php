		<?php zilla_sidebar_before(); ?>
		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
			
		<?php 
		    zilla_sidebar_start();
			
			/* Widgetised Area */ 
			dynamic_sidebar( 'glendonbrook-3' );
			include_once ('includes/acf-project.php');
			dynamic_sidebar( 'glendonbrook-5' );
			//dynamic_sidebar( 'projects-5' );
			
			zilla_sidebar_end();
		?>
		
		<!--END #sidebar .aside-->
		</div>
		<?php zilla_sidebar_after(); ?>