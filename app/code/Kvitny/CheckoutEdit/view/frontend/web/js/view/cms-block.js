define(
    [
        'uiComponent',
        'jquery',
        'ko'
    ],
    function(
        Component,
        $,
        ko
    ) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Kvitny_CheckoutEdit/cms-block'
            },

            initialize: function () {
                var self = this;
                this._super();
            }

        });
    }
);
