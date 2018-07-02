<?php
    //Price
	$yog_symbol = yog_helper()->get_option( 'inventory-price-currency', 'raw', '$', 'options' );
	$yog_reg_price = get_post_meta(get_the_ID(),'inv_price',true);
	$yog_sale_price = get_post_meta(get_the_ID(),'inv_sale_price',true);

	if(!empty($yog_sale_price)) {
		$yog_price = $yog_sale_price;
	} elseif(!empty($yog_reg_price)) {
		$yog_price = $yog_reg_price;
	} else {
		$yog_price = '';
	}
?>
<div class="widget custom-widget clearfix">
    <div class="calculator">
        <div class="calculator-title">
            <h4>Payment Calculator</h4>
        </div><!-- end title -->
        <div class="search-tab light-tab calculator-body">
            <div class="search-wrapper">
                <form class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-input">    
                            <label><?php printf( '%s (%s)', yog_get_translation( 'tr-inv-cal-price' ), $yog_symbol ); ?></label>
                            <input type="text" class="numbersOnly vehicle_price form-control" value="<?php echo esc_attr($yog_price); ?>"/>
                        </div><!-- end form-input -->
                        <div class="form-input">
                            <label><?php printf( '%s (%s)', yog_get_translation( 'tr-inv-cal-down-payment' ), $yog_symbol ); ?></label>
                            <input type="text" class="numbersOnly down_payment form-control"/>
                        </div><!-- end form-input -->
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-input">
                            <label><?php yog_translation( 'tr-inv-cal-month' ); ?></label>
                            <input type="text" class="numbersOnly period_month form-control"/>
                        </div><!-- end form-input -->
                    </div><!-- end col -->

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-input">
                            <label><?php yog_translation( 'tr-inv-cal-interest' ); ?></label>
                            <input type="text" class="numbersOnly interest_rate form-control"/>
                        </div><!-- end form-input -->
                    </div><!-- end col -->

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <hr class="invis2" />
                        <h5><?php yog_translation( 'tr-inv-cal-result-month' ); ?></h5>
                        <label><p class="monthly_payment"></p></label>
                        <hr class="invis2" />
                        <h5><?php yog_translation( 'tr-inv-cal-result-interset' ); ?></h5>
                        <p class="total_interest_payment"></p>
                        <hr class="invis2" />
                        <h5><?php yog_translation( 'tr-inv-cal-result-amount' ); ?></h5>
                        <p class="total_amount_to_pay"></p>
                        <hr class="invis2" />
                        <a href="#" class="btn btn-default btn-block calculate_loan_payment"><?php yog_translation( 'tr-inv-cal-btn' ); ?></a>
                    </div><!-- end col -->
                </form>
            </div><!-- end search wrapper -->
        </div><!-- end body -->
    </div><!-- end calculator -->   
</div><!-- d widget -->
<script type="text/javascript">
	(function($) {
		"use strict";

		$(document).ready(function () {
			var vehicle_price;
			var interest_rate;
			var down_payment;
			var period_month;
			$('.calculate_loan_payment').click(function(e){
				e.preventDefault();

				//Useful vars
				var current_calculator = $(this).closest('.stm_auto_loan_calculator');

				var calculator_alert = current_calculator.find('.calculator-alert');
				//First of all hide alert
				calculator_alert.removeClass('visible-alert');

				//4 values for calculating
				vehicle_price = parseFloat(current_calculator.find('input.vehicle_price').val());

				interest_rate = parseFloat(current_calculator.find('input.interest_rate').val());
				interest_rate = interest_rate/1200;

				down_payment = parseFloat(current_calculator.find('input.down_payment').val());

				period_month = parseFloat(current_calculator.find('input.period_month').val());

				//Help vars

				var validation_errors = true;

				var monthly_payment = 0;
				var total_interest_payment = 0;
				var total_amount_to_pay = 0;

				//Check if not nan
				if(isNaN(vehicle_price)){
					calculator_alert.text("<?php esc_html_e('Please fill Vehicle Price field', 'engines'); ?>");
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.vehicle_price').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else if (isNaN(interest_rate)) {
					calculator_alert.text("<?php esc_html_e('Please fill Interest Rate field', 'engines'); ?>");
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.interest_rate').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else if (isNaN(period_month)) {
					calculator_alert.text("<?php esc_html_e('Please fill Period field', 'engines'); ?>");
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.period_month').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else if (isNaN(down_payment)) {
					calculator_alert.text("<?php esc_html_e('Please fill Down Payment field', 'engines'); ?>");
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else if (down_payment > vehicle_price) {
					//Check if down payment is not bigger than vehicle price
					calculator_alert.text("<?php esc_html_e('Down payment can not be more than vehicle price', 'engines'); ?>");
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else {
					validation_errors = false;
				}

				if(!validation_errors) {
					var interest_rate_unused = interest_rate;

					if(interest_rate == 0) {
						interest_rate_unused = 1;
					}
					monthly_payment = (vehicle_price - down_payment) * interest_rate_unused * Math.pow(1 + interest_rate, period_month);
					var monthly_payment_div = ((Math.pow(1 + interest_rate, period_month)) - 1);
					if(monthly_payment_div == 0) {
						monthly_payment_div = 1;
					}

					monthly_payment = monthly_payment/monthly_payment_div;
					monthly_payment = monthly_payment.toFixed(2);

					total_amount_to_pay = down_payment + (monthly_payment*period_month);
					total_amount_to_pay = total_amount_to_pay.toFixed(2);

					total_interest_payment = total_amount_to_pay - vehicle_price;
					total_interest_payment = total_interest_payment.toFixed(2);

					current_calculator.find('.monthly_payment').text('<?php echo esc_attr($currency_symbol); ?>' + monthly_payment);
					current_calculator.find('.total_interest_payment').text('<?php echo esc_attr($currency_symbol); ?>' + total_interest_payment);
					current_calculator.find('.total_amount_to_pay').text('<?php echo esc_attr($currency_symbol); ?>' + total_amount_to_pay);
				} else {
					current_calculator.find('.monthly_payment').text('');
					current_calculator.find('.total_interest_payment').text('');
					current_calculator.find('.total_amount_to_pay').text('');
				}
			})

			$(".numbersOnly").on("keypress keyup blur",function (event) {
				//this.value = this.value.replace(/[^0-9\.]/g,'');
				$(this).val($(this).val().replace(/[^0-9\.]/g,''));
				if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
					event.preventDefault();
				}

				if ( $(this).val() != '' ){
					$(this).closest('.form-group').removeClass('has-error');
				}
			});
		});

	})(jQuery);
</script>