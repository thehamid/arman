/*Code for owl carousel slider */
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        rtl: true,
        loop:true,
        margin:10,
        nav:false,
        dots: true,
        autoplay:true,
        autoplayTimeout:10000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
});


