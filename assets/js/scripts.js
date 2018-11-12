
function scroll_to(clicked_link, nav_height) {
    var element_class = clicked_link.attr('href').replace('#', '.');
    var scroll_to = 0;
    if (element_class != '.top-content') {
        element_class += '-container';
        scroll_to = $(element_class).offset().top - nav_height;
    }
    if ($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 1000);
    }
}


jQuery(document).ready(function () {

    /*
     Navigation
     */
    $('a.scroll-link').on('click', function (e) {
        e.preventDefault();
        scroll_to($(this), $('nav').height());
    });
    // toggle "navbar-no-bg" class
    $('.c-form-1-box').waypoint(function () {
        $('nav').toggleClass('navbar-no-bg');
    });

    /*
     Background slideshow
     */
    $('.top-content').backstretch("assets/img/backgrounds/test.jpg");
    $('.how-it-works-container').backstretch("assets/img/backgrounds/test2.jpg");
    $('.testimonials-container').backstretch("assets/img/backgrounds/12.jpg");
    $('.call-to-action-container').backstretch("assets/img/backgrounds/test4.jpg");
    $('footer').backstretch("assets/img/backgrounds/footer2.jpg");

    $('#top-navbar-1').on('shown.bs.collapse', function () {
        $('.top-content').backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function () {
        $('.top-content').backstretch("resize");
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        $('.testimonials-container').backstretch("resize");
    });

    /*
     Wow
     */
    new WOW().init();

    /*
     Modals
     */
    $('.launch-modal').on('click', function (e) {
        e.preventDefault();
        $('#' + $(this).data('modal-id')).modal();
    });

    /*
     Contact form
     */
    $('.c-form-1-box form input[type="text"], .c-form-1-box input[type="email"], .c-form-1-box input[type="tel"], .c-form-1-box form textarea').on('focus', function () {
        $('.c-form-1-box form input[type="text"], .c-form-1-box input[type="email"], .c-form-1-box input[type="tel"], .c-form-1-box form textarea').removeClass('contact-error');
    });


});


jQuery(window).load(function () {

    /*
     Hidden images
     */
    $(".modal-body img, .testimonial-image img").attr("style", "width: auto !important; height: auto !important;");

});
