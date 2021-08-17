define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('messages_hide.messages_hideJs',{
        options: {
            wrapper: null
        },

        _create: function() {
            this._hideTimeout();
        },

        _hideTimeout: function () {
            let self = this;
            setTimeout(function() {
                $(self.options.wrapper).hide('blind', {}, 500);
            }, 5000);
        }
    });

    return $.messages_hide.messages_hideJs;
});
