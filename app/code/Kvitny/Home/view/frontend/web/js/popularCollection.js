define([
    'jquery',
    'slick'
], function ($) {
    'use strict';

    $.widget('popularCollection.popularCollectionJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._slider();
        },

        _slider: function () {
            let self = this;
            $(self.options.wrapper).slick({
                dots: true,
                customPaging: function(slider, i) {
                    return '<span class="button page-indicator"></span>';
                },
                arrows: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                speed: 500,
                autoplaySpeed: 3000
            });
        }

    });

    return $.popularCollection.popularCollectionJs;

});
