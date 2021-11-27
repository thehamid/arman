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

/*Code for hide menu when scroll */
$(window).scroll(function(){
    var headerBottom = $('.header-bottom');
    var sticky = $('.sticky');
    var scroll = $(window).scrollTop();

    if (scroll >= 100){
        sticky.addClass('fixed');
        headerBottom.addClass('hide');
    }
    else {
        sticky.removeClass('fixed');
        headerBottom.removeClass('hide');
    }

});



/*Code for WoW animation start page */

var a = 0;
$(window).scroll(function() {

    var oTop = $('#counter').offset().top - window.innerHeight;
    if (a == 0 && $(window).scrollTop() > oTop) {
        $('.number').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({
                countNum: $this.text()
            }).animate({
                    countNum: countTo
                },

                {

                    duration: 5000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });
        });
        a = 1;
    }

});

/*Code for navigation show */
var menuBtn = document.querySelector('#hamberger');
var closeBtn = document.querySelector('#close');
var nav = document.querySelector('.navigation');
var lineOne = document.querySelector('nav .menu-btn .line--1');
var lineTwo = document.querySelector('nav .menu-btn .line--2');
var lineThree = document.querySelector('nav .menu-btn .line--3');
var link = document.querySelector('nav .nav-links');
menuBtn.addEventListener('click', () => {
    nav.classList.toggle('nav-open');

    $('.navigation ul.sub-menu').before("<i class='sub-menu-arrow fa fa-angle-left'></i> ");
    $( ".navigation .sub-menu-arrow" ).click(function() {
        if($(this).hasClass("fa-angle-left")) {
            $(this).next("ul.sub-menu").slideToggle();

        }
        else {
            $(this).next("ul.sub-menu").hide(500);

        }

    });
    lineOne.classList.toggle('line-cross');
    lineTwo.classList.toggle('line-fade-out');
    lineThree.classList.toggle('line-cross');
    link.classList.toggle('fade-in');
})

closeBtn.addEventListener('click', () => {
    nav.classList.toggle('nav-open');

    $('.navigation ul.sub-menu').before("<i class='sub-menu-arrow fa fa-angle-left'></i> ");
    $( ".navigation .sub-menu-arrow" ).click(function() {
        if($(this).hasClass("fa-angle-left")) {
           (this).removeClass("fa-angle-left").addClass("fa-angle-down");
        }
        else {
            $(this).removeClass("fa-angle-down").addClass("fa-angle-left");
        }

    });
})