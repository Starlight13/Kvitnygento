
require(['jquery', 'jquery/ui'], function($){
    jQuery(document).ready( function() {
        if(document.body.classList.contains("cms-index-index")) {
            $(document).on('scroll', () => {
                $('.page-header').toggleClass('solid', $(this).scrollTop() > $('.header.content').height());
            });
        }

        setTimeout(function() {
            $(".messages").hide('blind', {}, 500);
        }, 5000);

        $(".header__navigation-icon").on('click', () => {
            $("nav.navigation").slideToggle(500);
        })

        if ($(".header.content > ul.header.links > li:nth-child(1)").attr('class') == "customer-welcome") {
            $(".header.content > ul.header.links > li:nth-child(2)").on('click', function (event) {
                event.preventDefault();
                $("nav.navigation").slideToggle(500);
            })
        } else {
            $(".header.content > ul.header.links > li:nth-child(1)").on('click', function (event) {
                event.preventDefault();
                $("nav.navigation").slideToggle(500);
            })
        }

        $(".footer__arrow-up").on('click', function (event) {
            event.preventDefault();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(document.body).offset().top
            }, 1000);
        })
    });
});
