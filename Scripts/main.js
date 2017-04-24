$(function() {
	
	var sliderGroup = $('#flexsliders');
	var slideCaption = $('.slide-caption');
	var categorySlider = $('#category_slider');
	var brandSlider = $('#brand_slider');
	var latest_productsSlider = $('#latest_products_slider');
	var best_sellersSlider = $('#best_sellers_slider');
	var featured_leftSlider = $('#featured_slider_left');
	var featured_rightSlider = $('#featured_slider_right');
	var categories_Slider = $('#categories_slider');
	var upsell_Slider = $('#upsell_slider');
	var alsobought_Slider = $('#alsobought_slider');
	
	var basketnavHeight = $('.top-basket').height();
	
	$("a.clearFilterOptions").hide();
	
	//SET HIDDEN TOP BASKET
	$('.basket-contents').css({'top': basketnavHeight });
	
	$('.top-basket').hover(function() {
		$('.basket-contents').show();
	}, function() {
		$('.basket-contents').hide();
	});
	
	$('.basket-contents').hover(function() {
		$(this).show();
	}, function() {
		$(this).hide();
	});
	
	
	$('a.filterItemUnselected, a.filterItemSelected').click(function() {
      var $this = $(this);
      if ($this.hasClass('filterItemUnselected')) {
           $this.removeClass('filterItemUnselected').addClass('filterItemSelected');
           $(this).parents('.boxbottomBorderThin').find("a.clearFilterOptions").show();
      }
      else {
           $this.removeClass('filterItemSelected').addClass('filterItemUnselected');
      }
    return false;
    });
    
    $('.toggleControl').click(function() {
    	$(this).parent('h4').toggleClass("heading-icon-active").toggleClass("heading-icon");
    	$(this).parents('.boxbottomBorderThin').find("ul").toggle();	
    return false;
    });
    
    $('a.clearFilterOptions').click(function() {
    $(this).parents('.boxbottomBorderThin').find("ul.checkbox_list li a").removeClass('filterItemSelected').addClass('filterItemUnselected');
    	$(this).hide();	
    return false;
    });
	

	//SET THE FLEXSLIDER GROUP FUNCTIONS IF IT EXISTS
	if (sliderGroup.length) {
        intGroupSliders();
    }
    
    //SET THE SLIDING CAPTION FUNCTIONS IF THEY EXIST
    if (slideCaption.length) {
        intSlideCaption();
    }
    
    //SET THE CATEGORY SLIDER FUNCTIONS IF THEY EXIST
    if (categorySlider.length) {
        intcategorySlider();
    }
    
    //SET THE BRAND SLIDER FUNCTIONS IF THEY EXIST
    if (brandSlider.length) {
        intbrandSlider();
    }
    
    //SET THE LATEST PRODUCTS SLIDER FUNCTIONS IF THEY EXIST
    if (latest_productsSlider.length) {
        intlatest_productsSlider();
    }
    
    //SET THE BEST SELLERS SLIDER FUNCTIONS IF THEY EXIST
    
	if (best_sellersSlider.length) {
        intbest_sellersSlider();
    }
    
    if (featured_leftSlider.length) {
        intfeatured_leftSlider();
    }
    
    if (featured_rightSlider.length) {
        intfeatured_rightSlider();
    }
    
    if (categories_Slider.length) {
        intcategories_Slider();
    }
    
    if (upsell_Slider.length) {
        intupsell_Slider();
    }

    if (alsobought_Slider.length) {
        intalsobought_Slider();
    }

    
    
	
	
	
	$('.width').html($('.container').width());
	
	//DROP DOWN NAV
    var pull = $('#mobnav-trigger');
    menu = $('#main-nav ul');
    menuHeight = menu.height();

    $(pull).on('click', function (e) {
        e.preventDefault();
        menu.slideToggle();
    });
    
    //DROP DOWN SUB NAV
    var pulltrigger = $('.opener');
    submenu = $(pulltrigger).next('.dropdown');

    $(pulltrigger).on('click', function (e) {
        e.preventDefault();
        $(this).parent('.hasdropdown').toggleClass('active');
        submenu.slideToggle();
        return false;
    });
    
    //SHOW QUICK ACCESS BUTTONS
    var quickAccess = $('.quick-access-links');
    $('.quick-access-button').on('click', function () {
    	$('.links').toggleClass("quick-access-links").toggleClass("mobile-quick-access-links");
    	return false;		
    });

    
    $('.alert-box .close').on('click', function () {
    	$(this).parent().fadeOut('fast');
    });
    
    //setSlideCaption();
    //groupSliders();
    
   /* $('#hero_slider').flexslider({
            animation: "slide",
            animationLoop: true,
            slideshow: true,
            controlsContainer: ".header-slider",
            pauseOnAction: true,
            pauseOnHover: true
        });
    
    $('#cat_slider').flexslider({
	        animation: "slide",
	        animationLoop: true,
	        slideshow: false, 
	        itemWidth: 124,
	        itemMargin: 28,
	        minItems: 3,
	        maxItems: 6,
	        move: 3
	    });
	 
	$('#prd_right_slider, #prd_left_slider').flexslider({
	        animation: "slide",
	        animationLoop: true,
	        slideshow: false, 
	        itemWidth: 60,
	        itemMargin: 28,
	        minItems: 3,
	        maxItems: 3,
	        move: 3
	    });
   
    */
	/*
        $("#testForm").validate({
        // this is the html element that will wrap error messages
        errorElement: "span",
        rules: { 
                	user_email: {
                		required: true,
                		email: true	
                	}
       },
       messages: {
       		user_email: {
                    required: "Please enter your 'E-mail Address'",
                    email: "Please enter a valid 'E-mail Address",
                }
       },

        // this is where we'll place the error message
        errorPlacement: function (error, placement) {
            $(placement).qtip({
                content: error.text(),
                show: { when: { event: 'none' }, ready: true },
                hide: { when: { event: 'keydown' } },
                position: {
                    corner: {
                        target: 'topRight',
                        tooltip: 'bottomRight'
                    },
                    adjust: { x: -10, y: 10 }
                },

                style: {
                    padding: 3,
                    background: '#2BA6CB',
                    color: 'white',
                    textAlign: 'left',
                    border: {
                        width: 4,
                        radius: 3,
                        color: '#2BA6CB'
                    },
                    tip: 'bottomRight'

                }
            });
        }
    }

  ); */
  
        $('.testButton').on('click', function (e) {
            $('#modalBox').modal({
                show: 'fade'
            });
            return false;
        });
    
});

$(window).resize(function(){
	$('.width').html($('.container').width());
	
	var w = $(window).width();
        if (w > 320 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    
    sliderSize('#full-width-slider #flexsliders'); 
    intSlideCaption();
    //sliderHeight($('.flexslider').width(),$('.flexslider').height(), '.flexslider');

});



$(function() {

	//FUNCTION TO DECIDE IF MOBILE OR NOT
    function isMobile(){
         return ($(window).width() < 767);
    }
    
    //FUNCTION TO REMOVE SLIDER
    function flexdestroy(selector) {
	  var el = $(selector);
	  var elClean = el.clone();
	
	  elClean.find('.flex-viewport').children().unwrap();
	  elClean
	    .removeClass('flexslider standard-slider thumbSlider normVersion six-col-prd-slider').addClass('mobileVersion')
	    .find('.clone, .flex-direction-nav, .flex-control-nav')
	      .remove()
	      .end()
	    .find('*').removeAttr('style').removeClass (function (index, css) {
	      return (css.match (/\bflex\S+/g) || []).join(' ');
	    });  
	
	  elClean.insertBefore(el);
	  el.remove();        
	}
    
    //SET SLIDERS ON PAGE LOAD
    runPlugin();

	//RUN THE PLUGIN WHEN WINDOW IS RESIZED
    $(window).resize(function(){runPlugin();});
		// REAPLACE HR 
		$('hr').wrap('<div class="hr" />');

		//Function to run responsive scripts
		function runPlugin(){
			
			
	    	//Browser is MOBILE width we can then destroy the sliders
	    	if(isMobile()){
	    		flexdestroy('#categories_slider');
	    		flexdestroy('#latest_products_slider');
	    	}
	    
	    	//Browser is DESKTOP width
        	if(!isMobile()){
        		//$('#hero_slider').removeClass('mobileVersion');
        		$('#latest_products_slider').addClass('flexslider thumbSlider carousel six-col-prd-slider').removeClass('mobileVersion');
        		$('#categories_slider').addClass('flexslider carousel six-col-prd-slider').removeClass('mobileVersion');
        		//intlatest_productsSlider(); 
        		//intcategories_Slider(); 
       		}
	  }

});

//SET THE SLIDE CAPTIONS
var intSlideCaption = function () {
	$('.slide-caption').each(function(index) {
	  	var figureHeight = $(this).find('figure').height();
	  	var imgHeight = $(this).find('img').height();
	  	var figCaption = $(this).find('.caption');
	  	var figCaptionHeight = $(figCaption).height();
	  	
	  	
	  	var totalHeight = ( imgHeight );
	  	
	  	//$(this).height(imgHeight);
	  	$(figCaption).css('bottom', '-30px' );
	  	
	  		$(this).hover(function() {
				$(figCaption).stop().animate({'bottom': '-10px'});
				$(figCaption).find('.readMore').css({'visibility':'visible'});
			  }, function() {
				$(figCaption).stop().animate({'bottom': '-40px'});
				$(figCaption).find('.readMore').css({'visibility':'hidden'});
			  });
	});	
	
}


