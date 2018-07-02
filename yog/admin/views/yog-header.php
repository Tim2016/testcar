<?php $theme = yog_helper()->get_current_theme(); ?>
<header class="yog-dashboard-header">

	<div class="yog-dashboard-title  clearfix">

		<div class="yog-left">

			<h1>
				<?php printf( esc_html__( 'Welcome to %s!', 'engines' ), $theme->name ) ?>
				<div class="yog-label">
					<span><?php printf( esc_html__( 'Latest Update %s', 'engines' ), $theme->version ) ?></span>
				</div>
			</h1>

			<p><?php echo esc_html__( 'Thank you for using YOGThemes. YOGThemes will improve your overall web publishing experience.', 'engines' ) ?></p>

	   </div>

	   <figure class="yog-right">
		  <img src="<?php echo yog()->load_assets( 'img/yog-logo.png' ); ?>" alt="yog Logo">
	   </figure>

	</div>

	<div class="clearfix"></div>

	<ul class="yog-inline-nav yog-clearlist clearfix yog-nav-tabs">
		<li class="yog-left is-active"><a href="<?php echo esc_url( yog_helper()->yog_dashboard_page_url() ); ?>#yog-general"><?php echo esc_html__( 'General', 'engines' ) ?></a></li>
		<li class="yog-left"><a href="<?php echo esc_url( yog_helper()->yog_dashboard_page_url() ); ?>#yog-demos"><?php echo esc_html__( 'Demos', 'engines' ) ?></a></li>
		<li class="yog-left"><a href="<?php echo esc_url( yog_helper()->yog_plugin_page_url() ); ?>"><?php echo esc_html__( 'Plugins', 'engines' ) ?></a></li>
		<li class="yog-right"><a href="<?php echo esc_url( yog_helper()->yog_online_documentation_url() ); ?>" target="_blank"><i class="color fa fa-file-text-o"></i> <?php echo esc_html__( 'Documentation', 'engines' ) ?> <i class="fa fa-angle-right"></i></a></li>
	</ul>

</header>
