define([
    'jquery',
    'slick',
    'matchMedia'
], function ($, MediaCheck) {
    'use strict';

    $.widget('catalogCarousel.catalogCarouselJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._slider();
        },

        _slider: function () {
            let self = this,
                sliderOptions = {
                infinite: true,
                autoplay: true,
                speed: 500,
                autoplaySpeed: 3000,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 769,
                        settings: 'unslick'
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 1,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                ]
            }

            mediaCheck({
                media: '(max-width: 768px)',
                entry: function () {
                    $(self.options.wrapper).slick(sliderOptions);
                },
            });
        }
    });

    return $.catalogCarousel.catalogCarouselJs;
});
