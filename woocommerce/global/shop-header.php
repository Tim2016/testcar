<?php
//Check.
if( !yog_helper()->get_option('engines-top-bar', 'raw', false, 'options'  ) ){
    return;    
}
?>
<div class="list-top clearfix">
    <?php 
        if( yog_helper()->get_option( 'engines-shop-filter', 'raw', false, 'options' )  ){
            woocommerce_catalog_ordering();
        }
    ?>
    <?php 
        if( yog_helper()->get_option( 'engines-result-count', 'raw', false, 'options' ) ){
            woocommerce_result_count();
        }  
    ?>
</div>