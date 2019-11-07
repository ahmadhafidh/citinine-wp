<!-- sidebar -->
<aside class="sidebar col-lg-4 col-12" role="complementary">

	<?php //get_template_part('searchform'); ?>

	<div id="news-sidebar" class="news-sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-side-bar')) ?>
	</div>

</aside>
<!-- /sidebar -->
