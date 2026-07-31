/*!
 *      Author: DigitalDots
	name: script.js	
	requires: jquery	
 */

$(document).ready(function(){  
  $('.stellarnav').stellarNav({
    theme: 'plain',      
    breakpoint: 1199,      
    position: 'right', 
    menuLabel: '',
    closeLabel: '',       
    closeIcon: true,      
    openingSpeed: 250,    
    closingDelay: 250
  });
  
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 80) {
        $("nav").addClass("sticky");
        $(".header-spacer").addClass("active");
    } else {
        $("nav").removeClass("sticky");
        $(".header-spacer").removeClass("active");
    }
});
  
  
//   $(window).on('scroll', function() {
//       var navbar = $('nav');

//       if ($(this).scrollTop() > 0) {
//           navbar.addClass('scrolled');
//       } else {
//           navbar.removeClass('scrolled');
//       }
//   });
  
//   $(window).on('scroll', function() {
//       if ($(this).scrollTop() > 200) {
//           $('.scrollTop').fadeIn();
//       } else {
//           $('.scrollTop').fadeOut();
//       }
//   });

//   $('.scrollTop').on('click', function() {
//       $('html, body').animate({ scrollTop: 0 }, 600);
//   });
  
  
  var btn = $('#scrollTop');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });

 
  
    function isSearchPage() {
        return window.location.href.toLowerCase().includes('?s=');
    }
  
    if (isSearchPage()) {
        $(".popupOverlay, .popupBox").hide();
    }
  
    $(".openPopup").on("click", function(e) {
        e.preventDefault();
        $(".popupOverlay, .popupBox").fadeIn(200);
    });
  
    $(".popupClose, .popupOverlay").on("click", function() {
        $(".popupOverlay, .popupBox").fadeOut(200);
    });
  
    $(document).on("submit", ".popupBox .search-form", function() {
        $(".popupOverlay, .popupBox").fadeOut(200);
    });  
  
  
//   var swiper = new Swiper(".destiSwiper", {
//     slidesPerView: 3.5,
//     spaceBetween: 30,
//     loop: true,
//     centeredSlides: true,
//     loopedSlides: 3, // number of slides to loop, usually equal to slidesPerView
//     rewind: true,     // allows rewind if loop is false

//     on: {
//       init: function () {
//         this.slideTo(1, 0); // align first render
//       },
//     },

//     navigation: {
//       nextEl: ".swiper-button-next-desti",
//       prevEl: ".swiper-button-prev-desti",
//     },

//     breakpoints: {
//       1024: {
//         slidesPerView: 2.5,
//         spaceBetween: 30,
//       },
//       768: {
//         slidesPerView: 1, 
//         spaceBetween: 20,
//       },
//       480: {
//         slidesPerView: 1,
//         spaceBetween: 10,
//       },
//     },
//   });
  
  
  var swiper = new Swiper(".destiSwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    loop: true,
//     centeredSlides: true,
    loopedSlides: 3, // number of slides to loop
    rewind: true,     
    autoplay: {
      delay: 3000,     // optional autoplay
      disableOnInteraction: false,
    },

    navigation: {
      nextEl: ".swiper-button-next-desti",
      prevEl: ".swiper-button-prev-desti",
    },

    breakpoints: {
      1280: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 25,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      480: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 5,
      },
    },
  });

  
  var bannerSwiper = new Swiper(".bannerSwiper", {
    effect: "fade",
    fadeEffect: {
      crossFade: true, 
    },
    speed: 1800,       
    spaceBetween: 30,
    autoplay: {
      delay: 4000,      
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination-banner",
      clickable: true,
    },
    loop: true,
    
  });
  
  var travelLongueSwiper = new Swiper(".travelLongueSwiper", {
      slidesPerView: 3.5,
      spaceBetween: 20,
      loop: true,
      centeredSlides: true,
      centeredSlidesBounds: true, 
      rewind: true,
      autoplay: {
        delay: 5000,      
        disableOnInteraction: false,
      },

      pagination: {
        el: ".swiper-pagination-tl",
        clickable: true,
      },

      navigation: {
        nextEl: ".swiper-button-next-tl",
        prevEl: ".swiper-button-prev-tl",
      },

      breakpoints: {
        1280: {
          slidesPerView: 3.5,
        },
        1024: {
          slidesPerView: 2.5,
        },
        768: {
          slidesPerView: 1.8,
        },
        480: {
          slidesPerView: 1.2,
        },
        320: {
          slidesPerView: 1,
        },
      },
    });


  
    var wtSwiper = new Swiper(".wtSwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: ".swiper-button-next-wt",
        prevEl: ".swiper-button-prev-wt",
      },
      breakpoints: {
        1280: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 25,
        },
        768: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 5,
        },
      },
    });
  
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 0,
    speed: 600,
  });
  
});