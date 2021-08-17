define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('headerTransparency.headerTransparencyJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._toggleTransparency();
        },

        _toggleTransparency: function () {
            let self = this;

            if($('body').hasClass("cms-index-index")) {
                $(window).on('scroll', () => {
                    $(self.options.wrapper).toggleClass('solid', $('html, body').scrollTop() > $('.header.content').height());
                });
            }
        }

    });

    return $.headerTransparency.headerTransparencyJs;
});
