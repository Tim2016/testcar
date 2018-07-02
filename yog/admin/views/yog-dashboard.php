<?php
$demos = get_theme_support( 'yog-demos' )[0];
?>
<div class="wrap yog-wrap">

	<div class="yog-dashboard">
        
        <h1></h1>

		<?php require_once( get_template_directory().'/yog/admin/views/yog-header.php' ); ?>

		<div class="tab-content">
            <?php yog_action( 'before_admin_panel' ); ?>
			<div id="yog-general" role="tabpanel" class="yog-tab-pane yog-tab-is-active">

				<ul class="yog-cards-container clearfix">
                  
                  <li class="yog-card on-half">
                     <div class="yog-card-inner">
                        <p><?php echo esc_html__( 'We are a creative web design that specialized in WordPress and create awesome WordPress Theme to meet anyone needs. We are smart, intelligent, talented and best of all, we are super passionate about our work.', 'engines' )?></p>
                        <p><?php echo esc_html__( 'With our lots of talent and experience, we combine beautiful, modern designs with clean, functional code to produce stunning websites. A product that we offer help and guidance in using to each of our customers.', 'engines' ); ?></p>
                        <p><?php echo esc_html__( 'Follow us to stay up to date with our latest and greatest. We are working hard to bring you some perfect themes!', 'engines' ); ?></p>
                        <h2><?php echo esc_html__( 'Dedicated Support System', 'engines' ); ?></h2>
                        <p><?php echo esc_html__( 'We are always happy to help and we value our customers. All our files come with User Manual prepared specifically for each product, these help files are located inside your download packages.', 'engines' )?></p>
                        <div class="yog-card-footer clearfix">
                           <a class="yog-button" href="http://themeforest.net/user/steelthemes"><img src="<?php echo esc_url( yog()->load_assets( 'img/envato.png' ) ); ?>" alt="" /></a> 
                        </div>
                     </div>
                  </li>
                  
                  <li class="yog-card">
                     <div class="yog-card-inner">
                        <div class="yog-icon-container">
                           <i class="text-gradient fa fa-life-ring"></i>
                        </div>
                        <h3><?php echo esc_html__( 'Support Forums', 'engines' ) ?></h3>
                        <div class="yog-status yog-status-is-active">
                           <span><?php echo esc_html__( 'Community', 'engines' ) ?></span>
                        </div>
                        <div class="yog-card-footer clearfix">
                           <a class="yog-button" href="#"><span><?php echo esc_html__( 'Go to forums', 'engines' ) ?></span> <i class="fa fa-angle-right"></i></a>
                        </div>
                     </div>
                  </li>

                  <li class="yog-card">
                     <div class="yog-card-inner">
                        <div class="yog-icon-container">
                           <i class="text-gradient fa fa-file-text-o"></i>
                        </div>
                        <h3><?php echo esc_html__( 'Documentation', 'engines' ) ?></h3>
                        <div class="yog-status yog-status-is-active">
                           <span><?php echo esc_html__( 'Knowledge Base', 'engines' ) ?></span>
                        </div>
                        <div class="yog-card-footer clearfix">
                           <a class="yog-button" href="<?php echo esc_url( yog_helper()->yog_online_documentation_url() ); ?>" target="_blank"><span><?php echo esc_html__( 'Read Documentation', 'engines' ) ?></span> <i class="fa fa-angle-right"></i></a>
                        </div>
                     </div>
                  </li>

               </ul>
               <?php yog_action( 'after_admin_panel' ); ?>
			</div>

			<div id="yog-demos" role="tabpanel" class="yog-tab-pane">

				<?php if( ! empty( $demos )  && class_exists('Yog_Addons') ) : ?>
					<ul class="yog-cards-container clearfix">
					<?php foreach( $demos as $id => $demo ): ?>
						<li class="yog-card yog-card-demo yog-card-is-active">
							<div class="yog-card-inner">
								<div class="yog-icon-container">
		                           <img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_html( $demo['title'] ) ?>" />
		                        </div>
		                        <h3><?php echo esc_html( $demo['title'] ) ?></h3>
                                <div class="demo-loader" style="display: none;"></div>
                                <p><?php echo esc_html( $demo['description'] ); ?></p>
		                        <div class="yog-card-footer clearfix">
		                           <a class="yog-button" href="<?php echo esc_url( $demo['preview'] ); ?>"><span><?php echo esc_html__( 'Preview', 'engines' ) ?></span> <i class="fa fa-angle-right"></i></a>
		                           <a class="yog-button importer-btn" href="<?php echo admin_url( 'admin.php?page=yog&yog-import-demo='. $id ) ?>"><span><?php echo esc_html__( 'Import Demo', 'engines' ) ?></span> <i class="fa fa-angle-right"></i></a>
		                        </div>
		                    </div>
						</li>
					<?php endforeach; ?>
					</ul>
                <?php else: ?>   
                    <div class="notice demo inline notice-warning notice-alt"><p><?php echo esc_html__( 'Please install / activate Engines Core Addons plugin after that you can import theme demo contents', 'engines' )?></p></div> 
				<?php endif; ?>
			</div>

		</div>

	</div>

</div>
