
/*================================================
[  Table of contents  ]
================================================

:: Predefined Variables
:: Preloader
:: Mega menu
:: Search Bar
:: Owl carousel
:: Counter
:: Slider range
:: Countdown
:: Tabs
:: Accordion
:: List group item
:: Slick slider 
:: Mgnific Popup
:: PHP contact form 
:: Placeholder
:: Isotope
:: Scroll to Top
:: POTENZA Window load and functions

======================================
[ End table content ]
======================================*/
 
//POTENZA var
var POTENZA = {};
 
 (function($){
  "use strict";


/*************************
      Predefined Variables
*************************/ 
var $window = $(window),
	$document = $(document),
	$body = $('body'),
  $fullScreen = $('.fullscreen') || $('.section-fullscreen'),
  $halfScreen = $('.halfscreen');

//Check if function exists
$.fn.exists = function () {
	return this.length > 0;
};



  /*************************
       owl-carousel 
*************************/

 POTENZA.carousel = function () {
    $(".owl-carousel").each(function () {
        var $this = $(this),
            $items = ($this.data('items')) ? $this.data('items') : 1,
            $loop = ($this.data('loop')) ? $this.data('loop') : true,
            $navdots = ($this.data('nav-dots')) ? $this.data('nav-dots') : false,
            $navarrow = ($this.data('nav-arrow')) ? $this.data('nav-arrow') : false,
            $autoplay = ($this.attr('data-autoplay')) ? $this.data('autoplay') : true,
            $space = ($this.attr('data-space')) ? $this.data('space') : 30;     
            $(this).owlCarousel({
                loop: $loop,
                items: $items,
                responsive: {
                  0:{items: $this.data('xx-items') ? $this.data('xx-items') : 1},
                  480:{items: $this.data('xs-items') ? $this.data('xs-items') : 1},
                  768:{items: $this.data('sm-items') ? $this.data('sm-items') : 2},
                  980:{items: $this.data('md-items') ? $this.data('md-items') : 3},
                  1200:{items: $items}
                },
                dots: $navdots,
                margin:$space,
                nav: $navarrow,
                navText:["<i class='fa fa-angle-left fa-2x'></i>","<i class='fa fa-angle-right fa-2x'></i>"],
                autoplay: $autoplay,
                autoplayHoverPause: true   
            }); 
           
    }); 
}


POTENZA.rangeslider = function () {
    if ($(".range-slider").exists()) {
        $(".range-slider").slider({
          tooltip: 'always'
        });
    }
  };


/*************************
     Back to top
*************************/

  POTENZA.screenSizeControl = function () {
        if ($fullScreen.exists()) {

            $fullScreen.each(function () {
                var $elem = $(this),
                    elemHeight = $window.height();

                if($window.width() < 768 ) $elem.css('height', elemHeight/ 1.1);
                else $elem.css('height', elemHeight);
            });
        }
        if ($halfScreen.exists()) {
            $halfScreen.each(function () {
                var $elem = $(this),
                    elemHeight = $window.height();

                $elem.css('height', elemHeight / 1.5);
            });
        }
    };
/****************************************************
     POTENZA Window load and functions
****************************************************/

  //Window load functions
    $window.load(function () {
        
    });

   $window.resize(function() {
       POTENZA.screenSizeControl();
    });

 //Document ready functions
    $document.ready(function () {
        POTENZA.carousel(),
        POTENZA.rangeslider(),
        POTENZA.screenSizeControl();
    });


})(jQuery);



$( window ).load(function() {
  $(".tab-content .tab-pane").removeClass("active");
 $(".tab-content .tab-pane.in").addClass("active");
});


$(document).ready(function(){
  $('.points a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash;
      var $target = $(target);

      $('html, body').stop().animate({
          'scrollTop': $target.offset().top- '70'
      }, 700, 'swing', function () {
          window.location.hash = target;
      });
  });
  /**/
  $('.dealer_country').on('change', function() {
    var us_state = '<option value="">Select State</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="American Samoa">American Samoa</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Guam">Guam</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Northern Marianas Islands">Northern Marianas Islands</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Puerto Rico">Puerto Rico</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Virgin Islands">Virgin Islands</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>'
    var canada_state = '<option value="">Select State</option><option value="Alberta">Alberta</option><option value="British Columbia">British Columbia</option><option value="Manitoba">Manitoba</option><option value="New Brunswick">New Brunswick</option><option value="Newfoundland and Labrador">Newfoundland and Labrador</option><option value="Northwest Territories">Northwest Territories</option><option value="Nova Scotia">Nova Scotia</option><option value="Nunavut">Nunavut</option><option value="Ontario">Ontario</option><option value="Prince Edward Island">Prince Edward Island</option><option value="Quebec">Quebec</option><option value="Saskatchewan">Saskatchewan</option><option value="Yukon">Yukon</option>';
    //alert(this.value);
    if(this.value=='Country'){
    $('.dealer_state').html('<option>State/province</option>');
    }else if(this.value=='Canada'){
    $('.dealer_state').html(canada_state);
    $('.dealer_state option:first-child').text('Select Province');
    }else if(this.value=='United States'){
    $('.dealer_state').html(us_state);
    $('.dealer_state option:first-child').text('Select State');
    }
  });
  
  $('.customer_country').on('change', function() {
    var us_state = '<option value="">Select State</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="American Samoa">American Samoa</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Guam">Guam</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Northern Marianas Islands">Northern Marianas Islands</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Puerto Rico">Puerto Rico</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Virgin Islands">Virgin Islands</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>'
    var canada_state = '<option value="">Select State</option><option value="Alberta">Alberta</option><option value="British Columbia">British Columbia</option><option value="Manitoba">Manitoba</option><option value="New Brunswick">New Brunswick</option><option value="Newfoundland and Labrador">Newfoundland and Labrador</option><option value="Northwest Territories">Northwest Territories</option><option value="Nova Scotia">Nova Scotia</option><option value="Nunavut">Nunavut</option><option value="Ontario">Ontario</option><option value="Prince Edward Island">Prince Edward Island</option><option value="Quebec">Quebec</option><option value="Saskatchewan">Saskatchewan</option><option value="Yukon">Yukon</option>';
    //alert(this.value);
    if(this.value=='Country'){
    $('.customer_state').html('<option>State/province</option>');
    }else if(this.value=='Canada'){
    $('.customer_state').html(canada_state);
    $('.customer_state option:first-child').text('Select Province');
    }else if(this.value=='United States'){
    $('.customer_state').html(us_state);
    $('.customer_state option:first-child').text('Select State');
    }
  });
  
  $('.seller_country').on('change', function() {
    var us_state = '<option value="">Select State</option><option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="American Samoa">American Samoa</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="Delaware">Delaware</option><option value="District of Columbia">District of Columbia</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Guam">Guam</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Northern Marianas Islands">Northern Marianas Islands</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Puerto Rico">Puerto Rico</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Virgin Islands">Virgin Islands</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>'
    var canada_state = '<option value="">Select State</option><option value="Alberta">Alberta</option><option value="British Columbia">British Columbia</option><option value="Manitoba">Manitoba</option><option value="New Brunswick">New Brunswick</option><option value="Newfoundland and Labrador">Newfoundland and Labrador</option><option value="Northwest Territories">Northwest Territories</option><option value="Nova Scotia">Nova Scotia</option><option value="Nunavut">Nunavut</option><option value="Ontario">Ontario</option><option value="Prince Edward Island">Prince Edward Island</option><option value="Quebec">Quebec</option><option value="Saskatchewan">Saskatchewan</option><option value="Yukon">Yukon</option>';
    //alert(this.value);
    if(this.value=='Country'){
    $('.seller_state').html('<option>State/province</option>');
    }else if(this.value=='Canada'){
    $('.seller_state').html(canada_state);
    $('.seller_state option:first-child').text('Select Province');
    }else if(this.value=='United States'){
    $('.seller_state').html(us_state);
    $('.seller_state option:first-child').text('Select State');
    }
  });
  
  /* Registation Tier*/
  i = 1;
  
  $('.btn.outline-btn').click(function(){
    var j = i-1;
    var html = '<div class="defaul-tier'+i+'">';
html = html+'<div class="col-sm-12">';
html = html+'<label for="exampleInputFirstName"></label><br>';
html =html+'<span class="wpcf7-form-control-wrap tire-brand">';
html =html+'<select name="tire_brand[]" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false">';
html =html+'<option value="Tire Brands">Tire Brands</option>';
html =html+'<option value="Federal">Federal</option>';
html =html+'<option value="Noble">Noble</option>';
html=html+'<option value="Landy">Landy</option>';
html=html+'<option value="Tracmax">Tracmax</option>';
html =html+'</select>';
html =html+'</span>';
html =html+'</div>';
html =html+'<div class="col-sm-6">';
html =html+'<div class="form-group">';
html =html+'<label for="exampleInputFirstName"></label><br>';
html =html+'<span class="wpcf7-form-control-wrap tire-identification-number"><input name="tire_identification_number[]" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="exampleInputFirstName" aria-required="true" aria-invalid="false" placeholder="Tire Identification Number" type="text"></span>';
html =html+'</div>';
html =html+'<p></p>';
html=html+'</div>';
html =html+'<div class="col-sm-6">';
html =html+'<div class="form-group">';
html =html+'<label for="exampleInputFirstName"></label><br>';
html =html+'<span class="wpcf7-form-control-wrap qty"><input name="tire_qty[]" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="exampleInputFirstName" aria-required="true" aria-invalid="false" placeholder="Quantity" type="text"></span>';
html =html+'</div>';
html =html+'<p></p>';
html =html+'</div>';
html =html+'</div>';
    if(i==1){
    $(html).insertAfter('.defaul-tier');
    }else{
    var classname = '.defaul-tier'+j;
    $(html).insertAfter(classname);    
    }
    if(i==2){
        $('.btn.outline-btn').hide();
    }
    i++;
  });
});