(function($) {
  'use strict';  
    /*---------------------------------
        Preloader JS
    -----------------------------------*/ 
    var prealoaderOption = $(window);
    prealoaderOption.on("load", function () {
        var preloader = jQuery('.spinner');
        var preloaderArea = jQuery('.preloader_area');
        preloader.fadeOut();
        preloaderArea.delay(350).fadeOut('slow');
    });
    /*---------------------------------
        Preloader JS
    -----------------------------------*/

    /*---------------------------------  
        sticky header JS
    -----------------------------------*/
    $(window).on('scroll',function() {    
        var scroll = $(window).scrollTop();
         if (scroll < 100) {
          $(".header_area").removeClass("sticky");
         }else{
          $(".header_area").addClass("sticky");
         }
    }); 
    /*---------------------------------  
        sticky header JS
    -----------------------------------*/
     /*---------------------
        Sidebar-menu js
    -----------------------*/
    $(".menu_icon,.close_btn,.sidebar-menu li a").on('click', function (e) {
      $(".menu_icon").toggleClass("active");
    });
    $(".menu_icon,.close_btn").on('click', function (e) {
      e.preventDefault();
      $(".sidenav_menu").toggleClass("active");
    });
    $.sidebarMenu($('.sidebar-menu'));
    /*---------------------------------
        page_scroll top JS
    --------------------------------*/
    $("a.page_scroll").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            //console.log($(hash).offset().top - topOffset);
            $('html, body').animate({
                scrollTop: $(hash).offset().top - $("header").outerHeight() + "px"
            }, 1200, function () {

                //window.location.hash = hash;
            });
        } // End if
    });
    /*======================================/
                  scroll top JS
    ======================================*/
    /*---------------------- 
        Scroll top js
    ------------------------*/
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > 100) {
          $('#scroll_up').fadeIn();
      } else {
          $('#scroll_up').fadeOut();
      }
    });
    $('#scroll_up').on('click', function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    /*---------------------- 
        Scroll top js
    ------------------------*/
    /*---------------------- 
        slick slider js
    ------------------------*/
    $('.case_study_slide').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 400,
        dots: true,
        arrows: false,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1
              }
            }
        ]
    });
    $('.team_slider').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 400,
        dots: true,
        arrows: false,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1
              }
            }
        ]
    });
    $('.client_slider').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 400,
        dots: false,
        arrows: false
    });
    $('.client_slider_2').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 400,
        dots: false,
        arrows: true
    });
    $('.sponsor_slide').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 400,
        dots: false,
        arrows: false,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2
              }
            }
        ]
    });
    /*---------------------- 
        slick slider js
    ------------------------*/  
    /*---------------------- 
        Isotope js
    ------------------------*/ 
    $('#work_masonry').imagesLoaded( function() {
        var $grid = $('.masonry_grid').isotope({
          itemSelector: '.work_item',
          masonry: {
            columnWidth: 1
          }
        })
    });
    /*---------------------- 
        Isotope js
    ------------------------*/
    /*----------------------
        Counter js
    ------------------------*/
    $('.counter').counterUp({
      delay: 60,
      time: 2000
    });
    /*----------------------
        Counter js
    ------------------------*/
})(window.jQuery);   