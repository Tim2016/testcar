<?php
/**
 * [yog_inventory_order_filter description]
 * @method yog_inventory_order_filter
 * @return [type]                      [description]
 */
function yog_inventory_order_filter( $args = array() ) {
    $defaults = array(
        'limit'     => '-1',
        'columns'    => 3,
        'animation' => false,
        'layout'    => 'grid'
    );
    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );
    
    ?>
    <div class="pull-left">
        <div class="form-input">
            <label class=""><?php yog_translation('tr-inv-order-fiter'); ?></label>
            <select name="orderby" class="selectpicker orderby" data-limit="<?php echo esc_attr( $limit ); ?>" data-column="<?php echo esc_attr( $columns ); ?>" data-animation="<?php echo esc_attr( $animation ); ?>" data-layout="<?php echo esc_attr( $layout ); ?>">
                <option value=""><?php yog_translation('tr-inv-order-by'); ?></option>
                <option value="price_high"><?php yog_translation('tr-inv-order-price-high'); ?></option>
                <option value="price_low"><?php yog_translation('tr-inv-order-price-low'); ?></option>
                <option value="mileage_high"><?php yog_translation('tr-inv-order-mileage-high'); ?></option>
                <option value="mileage_low"><?php yog_translation('tr-inv-order-mileage-low'); ?></option>
                <option value="date_low"><?php yog_translation('tr-inv-order-date-highest'); ?></option>
                <option value="date_high"><?php yog_translation('tr-inv-order-date-lowest'); ?></option>
            </select>
        </div><!-- end form-input -->
    </div><!-- end left -->
    <?php
}

/**
 * [yog_inventory_order_filter description]
 * @method yog_inventory_order_filter
 * @return [type]                      [description]
 */
function yog_inventory_grid_filter_html( $yog_layout = '' ) {
    if( $yog_layout == 'grid' ):
    ?>
    <div class="pull-right hidden-xs">
        <ul class="list-inline">
            <li class="active grid"><a href="#"><i class="flaticon-grid"></i></a></li>
            <li class="list"><a href="#"><i class="flaticon-list"></i></a></li>
        </ul><!-- end ul -->
    </div><!-- end right -->
    <?php   
    else:
    ?>
    <div class="pull-right hidden-xs">
        <ul class="list-inline">
            <li class="grid"><a href="#"><i class="flaticon-grid"></i></a></li>
            <li class="active list"><a href="#"><i class="flaticon-list"></i></a></li>
        </ul><!-- end ul -->
    </div><!-- end right -->
    <?php
    endif;
}

/**
 * [yog_get_inv_price description]
 * @method yog_get_inv_price
 * @return [type]                      [description]
 */
function yog_get_inv_price( $price = '' ) {
    //Check
    if( !isset( $price ) && empty( $price ) ){
        return;
    }
    
    $yog_currency = yog_helper()->get_option( 'inventory-price-currency', 'raw', '$', 'options' );
    $yog_currency_postion = yog_helper()->get_option( 'inventory-price-currency-postion', 'raw', 'left', 'options' );
    if( $yog_currency_postion == 'right' ){
        return $price.$yog_currency;
    }else{
        return $yog_currency.$price;
    } 
}