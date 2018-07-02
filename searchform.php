<?php
/**
 * The template for displaying search form.
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
    <div class="sidebar-blog-search inner-addon right-addon">
        <i class="icos glyphicon glyphicon-search"></i>
        <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr( yog_helper()->get_option( 'tr-blog-search', 'raw', 'Search..', 'options' ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
    </div>
</form>