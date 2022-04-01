function productGallary() {
    if ($(".product-active").length && $(".product-thumbnil-active").length) {
        var t = $(".product-active"),
            e = $(".product-thumbnil-active"),
            a = !1;
        t.owlCarousel({
            items: 1,
            margin: 0,
            nav: !1,
            dots: !1
        }).on("changed.owl.carousel", function(t) {
            a || (a = !0, e.trigger("to.owl.carousel", [t.item.index, 500, !0]), a = !1)
        }), e.owlCarousel({
            margin: 10,
            items: 3,
           	nav: true,
            dots: false,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            center: !1,
            responsive: {
                0: {
                    items: 2,
                    autoWidth: !1
                },
                400: {
                    items: 2,
                    autoWidth: !1
                },
                500: {
                    items: 2,
                    center: !1,
                    autoWidth: !1
                },
                600: {
                    items: 3,
                    autoWidth: !1
                },
                1200: {
                    items: 3,
                    autoWidth: !1
                }
            }
        }).on("click", ".owl-item", function() {
            t.trigger("to.owl.carousel", [$(this).index(), 500, !0])
        }).on("changed.owl.carousel", function(e) {
            a || (a = !0, t.trigger("to.owl.carousel", [e.item.index, 500, !0]), a = !1)
        })
    }
}

function ImageView(t) {
    if (t.files && t.files[0]) {
        var e = new FileReader;
        e.onload = function(t) {
            $("#image1").attr("src", t.target.result).attr("class", "img-thumbnail").attr("height", "100%").attr("width", "100%")
        }, e.readAsDataURL(t.files[0])
    }
}


$(".product-active .item").zoom(), productGallary(), $("#toggle2").on("click", function() {
    $("#open2").slideToggle()
}),


(function($){
	"use strict";
	
	
	$(document).on('ready', function(){


		$('.open-menu-btn').on('click', function(){
			if($('body').hasClass('closed-menu')){
			  $('body').removeClass('closed-menu');
			}else  $('body').addClass('closed-menu');
		  });

		  $('.sub-menu ul').hide();
			$(".sub-menu a").click(function () {
				$(this).parent(".sub-menu").children("ul").slideToggle("100");
				$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
			});

		// number count for stats, using jQuery animate
		$('.slider').slick({
			dots: true,
			arrows: true,
			autoplay: true,
  			autoplaySpeed: 3000,
			nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="fas fa-chevron-right"></i></div>',
			prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="fas fa-chevron-left"></i></div>',
			
		});



		var QtyInput = (function () {
			var $qtyInputs = $(".qty-input");
		
			if (!$qtyInputs.length) {
				return;
			}
		
			var $inputs = $qtyInputs.find(".product-qty");
			var $countBtn = $qtyInputs.find(".qty-count");
			var qtyMin = parseInt($inputs.attr("min"));
			var qtyMax = parseInt($inputs.attr("max"));
		
			$inputs.change(function () {
				var $this = $(this);
				var $minusBtn = $this.siblings(".qty-count--minus");
				var $addBtn = $this.siblings(".qty-count--add");
				var qty = parseInt($this.val());
		
				if (isNaN(qty) || qty <= qtyMin) {
					$this.val(qtyMin);
					$minusBtn.attr("disabled", true);
				} else {
					$minusBtn.attr("disabled", false);
					
					if(qty >= qtyMax){
						$this.val(qtyMax);
						$addBtn.attr('disabled', true);
					} else {
						$this.val(qty);
						$addBtn.attr('disabled', false);
					}
				}
			});
		
			$countBtn.click(function () {
				var operator = this.dataset.action;
				var $this = $(this);
				var $input = $this.siblings(".product-qty");
				var qty = parseInt($input.val());
		
				if (operator == "add") {
					qty += 1;
					if (qty >= qtyMin + 1) {
						$this.siblings(".qty-count--minus").attr("disabled", false);
					}
		
					if (qty >= qtyMax) {
						$this.attr("disabled", true);
					}
				} else {
					qty = qty <= qtyMin ? qtyMin : (qty -= 1);
					
					if (qty == qtyMin) {
						$this.attr("disabled", true);
					}
		
					if (qty < qtyMax) {
						$this.siblings(".qty-count--add").attr("disabled", false);
					}
				}
		
				$input.val(qty);
			});
		})();
		
  
		// START CUSTOMER LOGOS SLIDER JS CODE
		$('.customer-logos').slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 1000,
			arrows: true,
			dots: false,
			pauseOnHover: false,
			nextArrow: '<div class="slick-custom-arrow slick-custom-arrow-right"><i class="fas fa-chevron-right"></i></div>',
			prevArrow: '<div class="slick-custom-arrow slick-custom-arrow-left"><i class="fas fa-chevron-left"></i></div>',
			
			responsive: [{
				breakpoint: 1200,
				settings: {
					slidesToShow: 1
				}
			  },{
				breakpoint: 768,
				settings: {
					slidesToShow: 1
				}
			  }, {
				breakpoint: 520,
				settings: {
					slidesToShow: 1
				}
			}]
		});
		// END CUSTOMER LOGOS SLIDER JS CODE

		var currentImage;
var thumbnails, thumbnailButtons;

window.addEventListener('DOMContentLoaded', function(e) {
  currentImage = document.querySelector('.current-image');
  
  /**
    When Slick is initialized, grab the DOM nodes for the thumbnails and watch for user interactions.
  */
  $('.thumbnails').on('init', function(e, slick) {
    thumbnailButtons = document.querySelectorAll('.thumbnails .thumbnail .thumbnail-button');

    // Update the large image each time a thumbnail is activated
    thumbnailButtons.forEach(function(thumbnailButton) {
      thumbnailButton.addEventListener('click', function(e) {
        activateThumbnail(thumbnailButton);
      });
    });
  });

  /**
    Initialize Slick Slider with recommended configuration options
  */
  $('.thumbnails').slick({
    slidesToShow: 3,
    prevArrow: '<button class="previous-button button">' +
               '  <span class="fas fa-angle-left" aria-hidden="true"></span>' +
               '  <span class="sr-only">Previous slide</span>' +
               '</button>',
    nextArrow: '<button class="next-button button">' +
               '  <span class="fas fa-angle-right" aria-hidden="true"></span>' +
               '  <span class="sr-only">Next slide</span>' +
               '</button>',
    infinite: false,
    responsive: [
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 375,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
  
  /**
    Update the large current image when a thumbnail button is activated.
  */
  function activateThumbnail(thumbnailButton) {
    // Swap the current image based to match the thumbnail
    // - If you'd like to use separate images, like higher-res versions, consider using the index to pick an appropriate src string from an array, or storing the URI of the higher-res image in a custom data attribute on the thumbnail.
    var newImageSrc = thumbnailButton.querySelector('img').getAttribute('src');
    var newImageAlt = thumbnailButton.querySelector('img').getAttribute('data-full-alt');
    currentImage.querySelector('img').setAttribute('src', newImageSrc);
    currentImage.querySelector('img').setAttribute('alt', newImageAlt);

    // Remove aria-current from any previously-activated thumbnail
    thumbnailButtons.forEach(function(button) {
      button.removeAttribute('aria-current');
    });

    // Indicate to screen readers which thumbnail is selected using aria-current
    thumbnailButton.setAttribute('aria-current', true);
  }  
});

		//function for radio buttons
function addCheckAttribute(){
	let val = 0;
	$("input[name='radio-price']").click(function(){
	  let prevVal = val;
	  val = $("input[name='radio-price']:checked").val();
	  if ( val !== prevVal) {
		$(this).attr('checked', true);
		$(`input[value=${prevVal}]`).attr('checked', false);
	  } 
	});
  };
  $(document).ready(function() {
	  addCheckAttribute();
  });
  

		$(function () {
			$("#chkPassport").click(function () {
				if ($(this).is(":checked")) {
					$("#dvPassport").show();
					$("#AddPassport").hide();
				} else {
					$("#dvPassport").hide();
					$("#AddPassport").show();
				}
			});
		});


		// TOP BUTTON JS CODE
		$('body').append('<div id="toTop" class="top-arrow"><i class="fas fa-angle-up"></i></div>');
		$(window).on('scroll', function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
			$('#toTop').fadeOut();
			}
		}); 
		$('#toTop').on('click', function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
		// END TOP BUTTON JS CODE
	});

}(jQuery));

