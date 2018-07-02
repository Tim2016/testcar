<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="product-review-tab">
		<ul class="nav nav-pills">
			<?php $loop = 0; foreach ( $tabs as $key => $tab ) : $active = ( $loop == 0 )? 'active' : ''; ?>
				<li class="<?php echo $active; ?>" >
					<a href="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="pill"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php $loop++; endforeach; ?>
		</ul>
        <div style="height: auto;" class="tab-content tpl-minimal-tabs-cont tab-content">
    		<?php $loop = 0;  foreach( $tabs as $key => $tab ) : $active = ( $loop == 0 )? 'active in' : ''; ?>
    			<div class="tab-pane fade  <?php echo $active; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel">
    				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
    			</div>
    		<?php $loop++;  endforeach; ?>
        </div>
	</div>

<?php endif; ?>
