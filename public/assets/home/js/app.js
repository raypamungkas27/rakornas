/* Theme Name: Delvy  - Responsive Business & Agency Template
   Author: Themesdesign
   Version: 1.0.0
   File Description: Main JS file of the template
*/

// STICKY
$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".sticky").addClass("nav-sticky");
    } else {
        $(".sticky").removeClass("nav-sticky");
    }
});

// SmoothLink
$('.navbar-nav a').on('click', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top - 0
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});

// scrollspy
// $("#navbarCollapse").scrollspy({
//     offset: 0
// });


// Owl-Carousel
$("#owl-carousel").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 2,
    itemsDesktop: [1199, 3],
    itemstablet: [768, 1],
    itemsDesktopSmall: [768, 1],
});

// Shreenshort

var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    loop: true,
    centeredSlides: true,
    slidesPerView: 2,
    initialSlide: 3,
    keyboardControl: true,
    mousewheelControl: false,
    lazyLoading: true,
    preventClicks: false,
    preventClicksPropagation: false,
    lazyLoadingInPrevNext: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    coverflow: {
        rotate: 0,
        depth: 200,
        modifier: 1,
        slideShadows: false,
        slidesPerView: 3,
    }
});

// magnificPopup
$('.mfp-image').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-fade',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1]
    }
});

// typed
$(".element").each(function(){
    var $this = $(this);
    $this.typed({
        strings: $this.attr('data-elements').split(','),
        typeSpeed: 100, // typing speed
        backDelay: 3000 // pause before backspacing
    });
});

// video
$(".player").mb_YTPlayer();

// flex-demo-8

$('.main-slider').flexslider({
    slideshowSpeed: 5000,
    directionNav: false,
    controlNav: true,
    autoplay: true,
    animation: "fade"
});

// Clients Section Owl Carousel

$("#client-logo").owlCarousel({
    slideSpeed : 200,
    autoPlay : true,
    pagination : false,
    responsiveClass:true,
    items:3,
 responsive:{
     0:{
         items:2,
     },
     320: {
        items:1,
     },
     768:{
         items:3,
         nav:false
     },
     1000:{
         loop:false
     }
 }
    });