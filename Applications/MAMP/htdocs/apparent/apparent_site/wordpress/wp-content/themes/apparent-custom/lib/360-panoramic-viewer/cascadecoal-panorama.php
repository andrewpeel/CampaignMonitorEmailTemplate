<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Panorama 360&deg;</title>
	<!--<link rel="stylesheet" href="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/assets-demos/css/demo.css" media="all" />-->
	<link rel="stylesheet" href="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/css/panorama360.css" media="all" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/js/jquery.mousewheel.min.js"></script>
	<script src="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/js/jquery.panorama360.js"></script>
	<!--<link rel="stylesheet" href="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/assets-demos/js/fancybox/jquery.fancybox.css" media="all" />
	<script src="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/assets-demos/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>-->
	<script>
	<!--
		$(function(){
			$('.panorama-view').panorama360({
				is360 : true,
				sliding_direction : 1,
				sliding_interval: 15
			});
		});
	-->
	</script>
	<style>
		body{
			margin: 0px;
		}
		@media screen and (min-width: 640px) {
			.panorama {
				width:100%;
				height:600px;
			}
		}
		@media screen and (max-width: 640px) {
			.panorama {
				width:100%;
				height:300px;
			}
		}
	</style>
</head>
<body>
	<div class="panorama">
		<div class="preloader"></div>
		<div class="panorama-view">
			<div class="panorama-container">
				<img src="http://cascadecoal.weareapparent.com.au/site/wordpress/wp-content/themes/cascadecoal-blox/lib/360-panoramic-viewer/images/Mt-Penny-Looking-North-H600-Q15.jpg" data-width="5101" data-height="600" alt="Mt Penny" />
			</div>
		</div>
	</div>
</body>
</html>