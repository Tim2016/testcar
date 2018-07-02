<?php
    //Get Post Meta Value.
    $yog_page_breadcrumb = ( yog_helper()->get_option( 'page-enable-breadcrumb', 'html', false, 'post' ) )? yog_helper()->get_option( 'page-enable-breadcrumb', 'html', false, 'post' ) : yog_helper()->get_option( 'page-enable-breadcrumb', 'html', false, 'options' );
    if( isset( $yog_page_breadcrumb ) && !empty( $yog_page_breadcrumb ) ){ 
       return; 
    }
?>
<div class="section page-title">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="title-area pull-left">
                    <h2><?php
                        if ( is_category() ) :
                        	printf( yog_helper()->get_option( 'tr-blog-cat', 'html', 'Category: %s', 'options'  ), single_cat_title( '', false ) );
                        elseif ( is_tag() ) :
                        	printf( yog_helper()->get_option( 'tr-blog-tag', 'html', 'Tags: %s', 'options'  ), single_tag_title( '', false ) );
                        elseif ( is_day() ) :
                        	printf(   yog_helper()->get_option( 'tr-blog-day', 'html', 'Day: %s', 'options'  ), get_the_date() );
                        elseif ( is_month() ) :
                        	printf( yog_helper()->get_option( 'tr-blog-monthly', 'html', 'Monthly: %s', 'options'  ), get_the_date( _x( 'F Y', 'monthly archives date format', 'engines' ) ) );
                        elseif ( is_year() ) :
                        	printf( yog_helper()->get_option( 'tr-blog-yearly', 'html', 'Yearly: %s', 'options'  ), get_the_date( _x( 'Y', 'yearly archives date format', 'engines' ) ) );
                        elseif( is_search() ):
                            printf( yog_helper()->get_option( 'tr-blog-search-result', 'html', 'Search Result of %s', 'options'  ), get_search_query() );
                        elseif( is_404() ):
                            echo yog_helper()->get_option( 'page-404-title', 'html', '404', 'options'  );
                        else :
                        	echo get_the_title( get_queried_object_id() );
                        endif;
                    ?></h2>
                </div><!-- /.pull-right -->
                <div class="pull-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <?php                    
                                if(function_exists('bcn_display')) {
                                    bcn_display_list();
                                }  
                            ?>
                        </ol>
                    </div><!-- end bread -->
                </div><!-- /.pull-right -->
            </div><!-- end col -->
        </div><!-- end page-title -->
    </div><!-- end container -->
</div><!-- end section -->