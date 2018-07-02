<?php
//Get Revolution Slider
$yog_rvslider = yog_helper()->get_option( 'rev_slider', 'raw', false, 'post' );

//Revolation Slider.
if( isset( $yog_rvslider ) && !empty( $yog_rvslider ) ) { ?>
   
<div class="slider-section">
    <?php RevSliderOutput::putSlider( $yog_rvslider, '' ) ?>  
</div>            
<?php
}
