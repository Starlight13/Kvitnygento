define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('arrow_up.arrow_upJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._scroll();
        },

        _scroll: function () {
            let self = this;
            $(self.options.wrapper).on('click', function (event) {
                event.preventDefault();
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(document.body).offset().top
                }, 1000);
            })
        }
    });

    return $.arrow_up.arrow_upJs;
});
