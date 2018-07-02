/**
  * @package Engines WordPress
  * 
  * Template Scripts
  * Created by SteelThemes
    Init Inventory JS
    
    0. Add Compare Items
    1. Remove Compare Items
    2. Grid Icon Toggle
    3. Order Filter
    4. Compare Features Hides
    5. Loan form calculator
*/

;(function($) {
	"use strict";

    var Core = {

        initialize: function() {

			// Add Compare Items
			this.yog_ajax_add_to_compare();
            
            //Remove Compare Items
            this.yog_ajax_remove_from_compare();
            
            //Grid Icon Toggle
            this.yog_grid_toggle();
            
            //Order Filter
            this.order_shorting();
            
            //Compare Features Hides
            this.features_hide();
            
            //Loan form calculator
            this.loan_calculator_module();
            
        },yog_ajax_add_to_compare: function(){
            $(document).on('click', '.add-to-compare', function(e){
                e.preventDefault();
                var dataId = $(this).attr('data-id');
                var dataAction = $(this).attr('data-action');
                if(typeof dataAction == 'undefined') {
                    dataAction = 'add';
                }
                var yog_timeout;
                if(typeof dataId != 'undefined') {
                    $.ajax({
                        url: yogTheme.links.ajax,
                        type: "POST",
                        dataType: 'json',
                        data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=yog_ajax_add_to_compare',
                        context: this,
                        beforeSend: function (data) {
                            $(this).addClass('disabled');
                            clearTimeout(yog_timeout);
                        },
                        success: function (data) {
                            $(this).removeClass('disabled');
                            clearTimeout(yog_timeout);
                            $('.single-add-to-compare').addClass('single-add-to-compare-visible');
                            if(typeof data.response != 'undefined') {
                                $('.single-add-to-compare .yog-title').text(data.response);
                            }
                            if(typeof data.length != 'undefined') {
                                $('.yog-current-cars-in-compare').text(data.length);
                            }
                            yog_timeout = setTimeout(function(){
                                $('.single-add-to-compare').removeClass('single-add-to-compare-visible');
                            }, 5000);
                            if(data.status != 'danger') {
                                if (dataAction == 'remove') {
                                    $(this).removeClass('yog-added');
                                    $(this).html('<i class="fa fa-area-chart"></i> ' + data.add_to_text);
                                    $(this).removeClass('hovered');
                                    $(this).attr('data-action', 'add');
                                } else {
                                    $(this).addClass('yog-added');
                                    $(this).html('<i class="fa fa-plus yog-unhover"></i><span class="yog-unhover"> ' + data.in_com_text + '</span><div class="yog-show-on-hover"><i class="fa fa-minus"></i> ' + data.remove_text + '</div>');
                                    $(this).removeClass('hovered');
                                    $(this).attr('data-action', 'remove');
                                }
                            }
                            
                            $( '.compare-count' ).text( data.counter );
                        }
                    });
                }
            });
        },yog_ajax_remove_from_compare: function(){
            $(document).on('click', '.remove-from-compare', function(e){
                e.preventDefault();
                var dataId = $(this).attr('data-id');
                var dataAction = $(this).attr('data-action');
                if(typeof dataId != 'undefined') {
                    $.ajax({
                        url: yogTheme.links.ajax,
                        type: "POST",
                        dataType: 'json',
                        data: '&post_id=' + dataId + '&post_action=' + dataAction + '&action=yog_ajax_add_to_compare',
                        context: this,
                        beforeSend: function (data) {
                            $(this).addClass('loading');
                            $('.compare-yog-header-' + dataId).hide('slow', function(){
                                $('.compare-yog-header-' + dataId).remove();
                                $('.yog-compare-row').append($('.compare-empty-car-top').html());
                            });
                            $('.compare-yog-body-' + dataId).hide('slow', function(){
                                $('.compare-yog-body-' + dataId).remove();
                                $('.yog-compare-body').append($('.compare-empty-car-bottom').html());
                            });
                            $('.compare-yog-footer-' + dataId).hide('slow', function(){
                                $('.compare-yog-footer-' + dataId).remove();
                            });
                        },
                        success: function (data) {
                            $( '.compare-count' ).text( data.counter );
                        }
                    });
                }
                
            });
        },yog_grid_toggle: function(){
            
            $('.grid > a').live('click',function(e) {
              e.preventDefault();  
              
              //set cookie time 20 sec.
              var date = new Date();
              date.setTime(date.getTime() + (20 * 1000));
              
              //set gridcookie with expires time.
              Cookies.set('gridcookie','grid' , { expires: date } );
              
              //reload page.
              location.reload();          
                                  
    	   });
           
           $('.list > a').live('click',function(e) {
              e.preventDefault();
               
              //set cookie time 20 sec.
              var date = new Date();
              date.setTime(date.getTime() + (20 * 1000));
              
              //set gridcookie with expires time.
              Cookies.set('gridcookie','list' , { expires: date } );
              
              //reload page.
              location.reload(); 
    	   });
           
        },order_shorting: function(){
            $('.orderby').on('change', function(){
                //init variables.
        		var filter = $(this);
                var sortBy = filter.val();
                var limit  = filter.data( 'limit' );
                var column = filter.data( 'column' );
                var animation = filter.data( 'animation' );
                var layout = filter.data( 'layout' );
                
        		$.ajax({
        			url:yogTheme.links.ajax,
        			data:{
        			 'action' : 'yogSorting',
                     'sort_order' : sortBy,
                     'column' : column,
                     'limit': JSON.stringify(limit),
                     'animation' : animation,
                     'layout' : layout
        			}, // form data
        			type:'POST', // POST
        			beforeSend:function(xhr){
                        $('#loader-wrapper').addClass('visiable');
                        $('html').addClass('loading');
                        $('.content-area').removeClass('in-visiable');
        			},
        			success:function(data){
                        $('#loader-wrapper').removeClass('visiable');
                        $('html').removeClass('loading');
        				$('.inventory-items').html(data); // insert data
        			}
        		});
        		return false;
        	});
        },features_hide: function(){
            $(".main-feature").on("click",function() {
                $(".main-features").toggle('slow',function(){
                    this.checked
                });
            });
            $(".additional-feature").on("click",function() {
                $(".additional-features").toggle('slow',function(){
                    this.checked
                });
            });
        },loan_calculator_module: function(){
            var vehicle_price;
			var interest_rate;
			var down_payment;
			var period_month;
            var currency_symbol;
            
			$('.calculate_loan_payment').click(function(e){
				e.preventDefault();

				//Useful vars
				var current_calculator = $(this).closest('.loan-calculator');
                var validation_msgs = $('.loan-calculator').data('vaildation');
                    currency_symbol = $('.loan-calculator').data('currency');
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
					calculator_alert.text(validation_msgs.price);
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.vehicle_price').closest('.form-group').addClass('has-error');
					validation_errors = true;
				}  else if (isNaN(down_payment)) {
					calculator_alert.text(validation_msgs.down_payment);
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
					validation_errors = true;
				} else if (down_payment > vehicle_price) {
					//Check if down payment is not bigger than vehicle price
					calculator_alert.text(validation_msgs.down_payment_exd);
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
					//validation_errors = true;
				} else if (isNaN(period_month)) {
					calculator_alert.text(validation_msgs.month);
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.period_month').closest('.form-group').addClass('has-error');
					validation_errors = true;
				}else if (isNaN(interest_rate)) {
					calculator_alert.text(validation_msgs.interest_rate);
					calculator_alert.addClass('visible-alert');
					current_calculator.find('input.interest_rate').closest('.form-group').addClass('has-error');
					validation_errors = true;
				}else {
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

					current_calculator.find('.monthly_payment').text(currency_symbol + monthly_payment);
					current_calculator.find('.total_interest_payment').text(currency_symbol+ total_interest_payment);
					current_calculator.find('.total_amount_to_pay').text(currency_symbol + total_amount_to_pay);
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
        }
   }
    
   $(document).ready(function() {
        
        Core.initialize(); 

   });
   
   $(window).load(function () {
        if( $( '.loan-calculator' ).length ){  
            var vehicle_price;
    		var interest_rate;
    		var down_payment;
    		var period_month;
            var currency_symbol;
    
    			//Useful vars
    			var current_calculator = $(this).closest('.loan-calculator');
                var validation_msgs = $('.loan-calculator').data('vaildation');
                    currency_symbol = $('.loan-calculator').data('currency');
                    
                var calculator_alert = current_calculator.find('.calculator-alert');    
    			//First of all hide alert
    			calculator_alert.removeClass('visible-alert');
    
    			//4 values for calculating
    			vehicle_price = parseFloat($('input.vehicle_price').val());
    
    			interest_rate = parseFloat($('input.interest_rate').val());
    			interest_rate = interest_rate/1200;
    
    			down_payment = parseFloat($('input.down_payment').val());
    
    			period_month = parseFloat($('input.period_month').val());
    
    			//Help vars
    
    			var validation_errors = true;
    
    			var monthly_payment = 0;
    			var total_interest_payment = 0;
    			var total_amount_to_pay = 0;
    
    			//Check if not nan
    			if(isNaN(vehicle_price) ){
    				calculator_alert.text(validation_msgs.price);
    				calculator_alert.addClass('visible-alert');
    				current_calculator.find('input.vehicle_price').closest('.form-group').addClass('has-error');
    				validation_errors = true;
    			}  else if (isNaN(down_payment)) {
    				calculator_alert.text(validation_msgs.down_payment);
    				calculator_alert.addClass('visible-alert');
    				current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
    				validation_errors = true;
    			} else if (down_payment > vehicle_price) {
    				//Check if down payment is not bigger than vehicle price
    				calculator_alert.text(validation_msgs.down_payment_exd);
    				calculator_alert.addClass('visible-alert');
    				current_calculator.find('input.down_payment').closest('.form-group').addClass('has-error');
    				//validation_errors = true;
    			} else if (isNaN(period_month)) {
    				calculator_alert.text(validation_msgs.month);
    				calculator_alert.addClass('visible-alert');
    				current_calculator.find('input.period_month').closest('.form-group').addClass('has-error');
    				validation_errors = true;
    			}else if (isNaN(interest_rate)) {
    				calculator_alert.text(validation_msgs.interest_rate);
    				calculator_alert.addClass('visible-alert');
    				current_calculator.find('input.interest_rate').closest('.form-group').addClass('has-error');
    				validation_errors = true;
    			}else {
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
    
    				$('.monthly_payment').text(currency_symbol + monthly_payment);
    				$('.total_interest_payment').text(currency_symbol + total_interest_payment);
    				$('.total_amount_to_pay').text(currency_symbol + total_amount_to_pay);
    			} else {
    				$('.monthly_payment').text('');
    				$('.total_interest_payment').text('');
    				$('.total_amount_to_pay').text('');
    			}
    	
    
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
        } 
    });
    
})(jQuery);