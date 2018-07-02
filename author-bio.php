<?php if( !yog_helper()->get_option( 'engines-author-box', 'raw', false, 'options' ) ) return; ?>
<div class="about-author clearfix">
    <div class="section-title small-margin-title clearfix">
        <h5><?php echo yog_helper()->get_option( 'engines-author-title', 'raw', false, 'options' ); ?></h5>
        <hr class="custom" />
    </div><!-- end section-title -->

    <div class="author-details">
        <?php 
            $yog_avt =  get_avatar( get_the_author_meta('ID'), 100 ); 
            echo str_replace( 'photo', 'photo alignleft', $yog_avt );
        ?>
        <h3><?php echo ucwords( get_the_author() ); ?></h3>
        <p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
        <a href="<?php echo get_the_author_meta('user_url') ?>"><?php echo get_the_author_meta('user_url') ?></a>
    </div><!-- end details -->
</div><!-- end about-author -->