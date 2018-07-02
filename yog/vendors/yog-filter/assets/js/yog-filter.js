 //////////////////////
// SEARCHY JS  - http://www.dopewp.com/searchy/
//////////////////////
// DOCUMENT READY
/////////////////////////////////////////////

;(function($) {
	"use strict";
    
    jQuery( document ).ready(function(){
        
        $('.date-picker-from').datepicker().on('changeDate', function(en) { 
            
            // AJAX FORM FOR MAIN SEARCH FORM
    		var options = { 
    			target:     '.car-list-wrapper',		 
    			url: '?searchy_ajax_results=1',
                beforeSubmit: function() {
    				$('#loader-wrapper').addClass('visiable');
                    $('html').addClass('loading');
                    $('.content-area').removeClass('in-visiable');
    			},
    		    success: function(data) { 
    				$('#loader-wrapper').removeClass('visiable');
                    $('html').removeClass('loading');
    			} 
    		}; 
    		
    		$('.searchy-search-form').ajaxForm(options);	
    
    		//  AT PAGE LOADING...
    		$(".searchy-trigger-search").click().hide(); //TRIGGER SEARCH
            
        }); 
        
        $("body").on("change",".searchy-search-form select,.searchy-search-form input",function() {
    		// AJAX FORM FOR MAIN SEARCH FORM
    		var options = { 
    			target:     '.car-list-wrapper',		 
    			url: '?searchy_ajax_results=1',
                beforeSubmit: function() {
    				$('#loader-wrapper').addClass('visiable');
                    $('html').addClass('loading');
                    $('.content-area').removeClass('in-visiable');
    			},
    		    success: function(data) { 
    				$('#loader-wrapper').removeClass('visiable');
                    $('html').removeClass('loading');
    			} 
    		}; 
    		
    		$('.searchy-search-form').ajaxForm(options);	
    
    		//  AT PAGE LOADING...
    		$(".searchy-trigger-search").click().hide(); //TRIGGER SEARCH
        });
                        
        $( '.show-more' ).on( 'click', function(e){ 
            e.preventDefault();
            var $this = $( this )
            var parentContent = $this.parent( '.checkbox-content' ).find( '.checkbox' ).toggleClass('hide-content');
            
        }); 
        
        $('.date-picker-to').datepicker(); 
        
        //Price
        var price_min = $( "#price-slider-range" ).data('min');
        var price_max = $( "#price-slider-range" ).data('max');
        $( "#price-slider-range" ).slider({
            min: 1,
            max: 100000,
            values: [ 1, 100000 ],
            slide: function( event, ui ) {
                $( "#price_min" ).val( $( "#price-slider-range" ).slider( "values", 0 ) );
                $( "#price_max" ).val( $( "#price-slider-range" ).slider( "values", 1 ) );
            },
            stop: function( event, ui ) {
                
                // AJAX FORM FOR MAIN SEARCH FORM
        		var options = { 
        			target:     '.car-list-wrapper',		 
        			url: '?searchy_ajax_results=1',
                    beforeSubmit: function() {
        				$('#loader-wrapper').addClass('visiable');
                        $('html').addClass('loading');
                        $('.content-area').removeClass('in-visiable');
        			},
        		    success: function(data) { 
        				$('#loader-wrapper').removeClass('visiable');
                        $('html').removeClass('loading');
        			} 
        		}; 
        		
        		$('.searchy-search-form').ajaxForm(options);	
        
        		//  AT PAGE LOADING...
        		$(".searchy-trigger-search").click().hide(); //TRIGGER SEARCH
            }
        });
        $( "#price_min" ).val( $( "#price-slider-range" ).slider( "values", 0 ) );
        $( "#price_max" ).val( $( "#price-slider-range" ).slider( "values", 1 ) );
        
        //Mileage
        var mileage_min = $( "#mileage-slider-range" ).data('min');
        var mileage_max = $( "#mileage-slider-range" ).data('max');
        $( "#mileage-slider-range" ).slider({
            min: mileage_min,
            max: mileage_max,
            values: [ mileage_min, mileage_max ],
            slide: function( event, ui ) {
                $( "#mileage_min" ).val( $( "#mileage-slider-range" ).slider( "values", 0 ) );
                $( "#mileage_max" ).val( $( "#mileage-slider-range" ).slider( "values", 1 ) );
            },
            stop: function( event, ui ) {
                
                // AJAX FORM FOR MAIN SEARCH FORM
        		var options = { 
        			target:     '.car-list-wrapper',		 
        			url: '?searchy_ajax_results=1',
                    beforeSubmit: function() {
        				$('#loader-wrapper').addClass('visiable');
                        $('html').addClass('loading');
                        $('.content-area').removeClass('in-visiable');
        			},
        		    success: function(data) { 
        				$('#loader-wrapper').removeClass('visiable');
                        $('html').removeClass('loading');
        			} 
        		}; 
        		
        		$('.searchy-search-form').ajaxForm(options);	
        
        		//  AT PAGE LOADING...
        		$(".searchy-trigger-search").click().hide(); //TRIGGER SEARCH
            }
        });
        $( "#mileage_min" ).val( $( "#mileage-slider-range" ).slider( "values", 0 ) );
        $( "#mileage_max" ).val( $( "#mileage-slider-range" ).slider( "values", 1 ) );
        
        	
    }); //END DOC READY
    

    (function(a) {
        a.fn.showMore = function(b) {
            var c = {
                speedDown: 300,
                speedUp: 300,
                height: "265px",
                showText: "Show",
                hideText: "Hide"
            };
            var b = a.extend(c, b);
            return this.each(function() {
                var e = a(this),
                    d = e.height() + 20;
                if (d > parseInt(b.height)) {
                    e.wrapInner('<div class="showmore_content" />');
                    e.find(".showmore_content").css("height", b.height);
                    e.append('<div class="showmore_trigger"><span class="more">' + b.showText + '</span><span class="less" style="display:none;">' + b.hideText + "</span></div>");
                    e.find(".showmore_trigger").on("click", ".more", function() {
                        a(this).hide();
                        a(this).next().show();
                        a(this).parent().prev().animate({
                            height: d
                        }, b.speedDown)
                    });
                    e.find(".showmore_trigger").on("click", ".less", function() {
                        a(this).hide();
                        a(this).prev().show();
                        a(this).parent().prev().animate({
                            height: b.height
                        }, b.speedUp)
                    })
                }
            })
        }
    })(jQuery);
    
    $(document).ready(function() {
         	
    	$('.showmore_one').showMore({
    		speedDown: 300,
    	        speedUp: 300,
    	        height: $( '.showmore_one' ).height() - 20,
    	        showText: 'Show more',
    	        hideText: 'Show less'
    	});
    	      
    }); 
    
})(jQuery);