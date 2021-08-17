define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('navigation_burger.navigation_burgerJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._toggle();
        },

        _toggle: function () {
            let self = this;
            $(self.options.wrapper).on('click', () => {
                $("nav.navigation").slideToggle(500);
            });
        }
    });

    return $.navigation_burger.navigation_burgerJs;
});
