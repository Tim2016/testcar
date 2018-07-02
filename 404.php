<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */

 get_header(); 
 
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
?>  
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="notfound text-center">
                        <h1><?php echo yog_helper()->get_option( 'page-404-title', 'html', esc_html__('404', 'engines' ), 'options' ); ?></h1>
                        <h3><?php echo yog_helper()->get_option( 'page-404-subtitle', 'html', esc_html__('Oops! the page you were looking for, could not be found.', 'engines'), 'options' ); ?></h3>
                        <p><?php echo yog_helper()->get_option( 'page-404-body', 'html', esc_html__( 'Try the search below to find matching pages:', 'engines'), 'options' ); ?></p>
                        <?php if(  'on' == yog_helper()->get_option( 'error-404-enable-search', 'raw', false, 'options' ) ): ?>
                            <form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="footer-newsletter clearfix">
                                <div class="input-group col-md-6 col-md-offset-3">
                                    <input type="text" name="s" class="form-control input-lg" placeholder="<?php echo yog_helper()->get_option( 'error-404-search-title', 'attr', esc_attr__('Search..', 'engines'), 'options' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-lg" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
get_footer();