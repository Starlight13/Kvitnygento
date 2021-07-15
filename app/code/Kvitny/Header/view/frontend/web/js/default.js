
require(['jquery', 'jquery/ui'], function($){
    jQuery(document).ready( function() {
        if(document.body.classList.contains("cms-index-index")) {
            $(document).on('scroll', () => {
                $('.page-header').toggleClass('solid', $(this).scrollTop() > $('.header.content').height());
                // $('nav.navigation').toggleClass('solid', $(this).scrollTop() > $('.header.content').height());
            });
        }

        setTimeout(function() {
            $(".messages").hide('blind', {}, 500);
        }, 5000);

        $("ul.header.links > li:nth-child(1)").on('click', function (event) {
            event.preventDefault();
            $("nav.navigation").slideToggle(500);
        })

        $(".footer__arrow-up").on('click', function (event) {
            event.preventDefault();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".banner").offset().top
            }, 1000);
        })
        // $(".showcart").on('click', function (event) {
        //     event.preventDefault();
        //     console.log($("#store\\.menu").is(':visible'));
        //     if($("#store\\.menu").is(':visible')) {
        //         $("#store\\.menu").slideToggle(100);
        //     }
        // })
    });
});
