// counter
var counted = 0;
$(window).scroll(function() {
var oTop = $('#counter').offset().top - window.innerHeight;
if (counted == 0 && $(window).scrollTop() > oTop) {
    $('.count').each(function() {
    var $this = $(this),
        countTo = $this.attr('data-count');
    $({
        countNum: $this.text()
    }).animate({
        countNum: countTo
        },
        {
        duration: 2000,
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
    counted = 1;
}
});

// partners
$('#partner').owlCarousel({
    loop:true,
    nav: false,
    margin:18,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:5,
            loop:false
        }
    }
})

// timeslot poup
$('.owl-timeslot').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})