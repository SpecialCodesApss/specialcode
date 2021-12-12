




			$(window).load(function() {
				$(".preloader").fadeOut(150);
			});
		
            $(document).ready(function(){

			$(".tab_block > div > label").click(function(){
				$("html, body").animate({scrollTop: $('.tab_block > div > input:checked ~ div').offset().top - 60}, 800);
			});

	    	$('.toggle-side-nav').click(function(){
				$('.website_containner').toggleClass('navmobwide');
				return false;
			});


	    	$('.link_delete a').click(function(){
				$('.pops_detail').addClass('shows_detail_pop');
            	$('.md-overlay').addClass('shows_overlay');
				return false;
			});
	    	$('.del').click(function(){
				$('.pops_detail').addClass('shows_detail_pop');
            	$('.md-overlay').addClass('shows_overlay');
				return false;
			});
	    	$('.md-overlay').click(function(){
            	$('.md-overlay').removeClass('shows_overlay');
            	$('.pops_detail').removeClass('shows_detail_pop');
				return false;
			});

			$(".delimgdrag").click(function(){
			  $(this).parents("li").remove();
			});



			$(".toggle-password").click(function() {
			  $(this).toggleClass("fa-eye fa-eye-slash");
			  var input = $($(this).attr("toggle"));
			  if (input.attr("type") == "password") {
				input.attr("type", "text");
			  } else {
				input.attr("type", "password");
			  }
			});
			
			
			

                $(document).scroll(function() {
                    var top = $(document).scrollTop();
                    if (top > 200) {
                        $(".header").addClass("head-sticky");
                        $(".top").addClass("top_show");
                    }
                    else if (top < 200) {
                        $(".header").removeClass("head-sticky");
                        $(".top").removeClass("top_show");
                    } 


                });
            });
	
	$(function(){

			$('.top').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 1200);
			});

	    	$('.consult').click(function(){
                $(".inner_form_popup").addClass("openpopup");
                $(".inner_form_popup").removeClass("closepopup_add");
               
			    $(".form_popup_block").addClass("openpopup_scroll");
                $(".form_popup_block").removeClass("closepopup_add_scroll");

				$(".form_popup_block").animate({ scrollTop: 0 }, 800);

                $("body").addClass("nonscroll");
	 			return false;
			});
	    	$('.closepopup').click(function(){
                $(".inner_form_popup").removeClass("openpopup");
                $(".inner_form_popup").addClass("closepopup_add");

                $(".form_popup_block").removeClass("openpopup_scroll");
                $(".form_popup_block").addClass("closepopup_add_scroll");
				
                $("body").removeClass("nonscroll");
	 			return false;
			});
			
			
	    	$('.overlaypopform').click(function(){
                $(".inner_form_popup").removeClass("openpopup");
                $(".inner_form_popup").addClass("closepopup_add");

                $(".form_popup_block").removeClass("openpopup_scroll");
                $(".form_popup_block").addClass("closepopup_add_scroll");
				
                $("body").removeClass("nonscroll");
	 			return false;
			});

			$('.in_form_search input').focusin(function(){
                $(".in_form_search").addClass("open");
			});
			$('.in_form_search input').focusout(function(){
                $(".in_form_search").removeClass("open");
			});




		});

     /*Image Extension Validation*/
    function fileValidationup(value,preview){
        var fileInput = document.getElementById(value);
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if(!allowedExtensions.exec(filePath)){
            alert('please upload banner with this Extensions .jpeg/.jpg only.');
            fileInput.value = '';
            return false;
        }else{
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+preview).html('<img class="img-responsive" src="'+e.target.result+'"/>');
                };
                reader.readAsDataURL(fileInput.files[0]);

            }
        }
    }

	//file inputupload
	
    /*script to click on browse btn when click on "upbtn" btn*/
    $("#upbtn").click(function (){
        $("#logo").click();
    });
      /*Image Extension Validation*/
    function fileValidation(){
        var fileInput = document.getElementById('logo');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if(!allowedExtensions.exec(filePath)){
            alert('please upload this with this Extensions .jpeg/.jpg only.');
            fileInput.value = '';
            return false;
        }else{
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html('<img class="img-responsive" src="'+e.target.result+'"/>');
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }
	
	
	
	//file inputupload
	
function DeleteConfirm(DelFormid){
  if (confirm('Are you sure you want to delete this Brand?')) {
    $("#DelForm"+DelFormid).submit();
    
  } else {
    return false;
  }
}
	
	
				$(document).ready(function() {
					var owl = $('.owl-clients');
					owl.owlCarousel({
					rtl: false,
					margin: 10,
					nav: false,
					loop: true,
					lazyLoad : false,
					autoplay:true,
					dots:true ,
					autoplayTimeout:5000,
					smartSpeed:1100,
					autoplayHoverPause:true,
					responsive: {
						  0: {
							items: 1
						  },
						  400: {
							items: 2
						  },
						  550: {
							items: 3
						  },
						  720: {
							items: 4
						  },
						  992: {
							items: 5
						  },
						  1170: {
							items: 6
						  },
						 }
						})
				  })

				$(document).ready(function() {
					var owl = $('.owl-product');
					owl.owlCarousel({
					rtl: false,
					margin: 20,
					nav: true,
					loop: false,
					lazyLoad : false,
					autoplay:true,
					dots:false ,
					autoplayTimeout:5000,
					smartSpeed:1100,
					autoplayHoverPause:true,
					responsive: {
						  0: {
							items: 1
						  },
						  450: {
							items: 2
						  },
						  600: {
							items: 3
						  },
						  900: {
							items: 4
						  },
						  2000: {
							items: 4
						  },
						 }
						})
				  })
			
			
			
jQuery(document).ready(function(){
  jQuery(".icon-reorder").on("click", function(e){
    e.preventDefault();
      var distance = jQuery('.col_page_content').css('left');
      var elm_class = jQuery(".icon-reorder").attr("class");
      if(elm_class=='icon-reorder') {
		jQuery(this).addClass("open");
        jQuery('.col_side_nav').animate({width: 'toggle'});
      } else {
		 jQuery(".icon-reorder").removeClass("open");
        jQuery('.col_side_nav').animate({width: 'toggle'});
      }
  });
});


			
//jQuery.noConflict();
	
	/**********Vertical Slide*********/
	
	jQuery('#nav li').on('click', function(e) {
	  jQuerythis = jQuery(this);
	  e.stopPropagation(); 

	  if(jQuerythis.has('ul').length) {
		e.preventDefault();
		var visibleUL = jQuery('#nav').find('ul:visible').length; 
		var ele_class = jQuery('ul', this).attr("class");
		if(ele_class != 'sub-menu opened')
		{
			jQuery('#nav').find('ul:visible').slideToggle("normal");
			jQuery('#nav').find('ul:visible').removeClass("opened");
			jQuery('#nav .icon-angle-down').addClass("closing");
			jQuery('.closing').removeClass("icon-angle-down");
			jQuery('.closing').addClass("icon-angle-left");
			jQuery('#nav .icon-angle-left').removeClass("closing");
		}
		jQuery('ul', this).slideToggle("normal");
		if(ele_class == 'sub-menu opened')
		{
			jQuery('ul', this).removeClass("opened");
			jQuery('.arrow', this).removeClass("icon-angle-down");
			jQuery('.arrow', this).addClass("icon-angle-left");
		}
		else
		{
			jQuery('ul', this).addClass("opened");
			jQuery('.arrow', this).removeClass("icon-angle-left");
			jQuery('.arrow', this).addClass("icon-angle-down");
		}
	  } 

});

/**********Horizontal Slide for i-phone*********/






