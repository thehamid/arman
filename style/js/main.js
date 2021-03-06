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


})

closeBtn.addEventListener('click', () => {
    nav.classList.toggle('nav-open');

});



$(function() {
    $('.navigation > ul > li').click(function(e) {
        e.stopPropagation();
        var $el = $('ul',this);
        $('.navigation ul > li > ul').not($el).slideUp();
        $el.stop(true, true).slideToggle(400);
    });
    $('.navigation > ul > li > ul > li').click(function(e) {
        e.stopImmediatePropagation();
    });
});


///Script for single-project.php
$(document).ready(function(){


    $(".btn-check").click(function(){

        var radioValue = $("input[name='project-option']:checked").val();

        if(radioValue){

            $("input[name='value']").val(radioValue);
            $('#farsi').text(wordifyfa(radioValue)+"??????????");
        }

    });
});

$('#input_number').keyup(function () {
    $('#farsi').text(wordifyfa($(this).val())+"??????????");
});


//Start gf date picker script
gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
    if ( formId == 1 && fieldId == 21 ) {
        optionsObj.minDate = 2;
        optionsObj.maxDate = 20;
    }
    return optionsObj;
} );
gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
    jQuery( ".datepicker" ).attr('readonly','readonly');
    return optionsObj;
});
//End gf date picker script




