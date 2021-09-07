define([
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Customer/js/model/customer'
], function (ko, Component, _, stepNavigator, customer) {
    'use strict';

    /**
     * mystep - is the name of the component's .html template,
     * <Vendor>_<Module>  - is the name of your module directory.
     */
    return Component.extend({
        defaults: {
            template: 'Kvitny_CheckoutEdit/mytest-step'
        },

        isVisible: ko.observable(true),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'test_step',
                null,
                'Test Step',
                this.isVisible,
                _.bind(this.navigate, this),
                15
            );

            return this;
        },

        navigate: function () {
            this.isVisible(true);
        },

        navigateToNextStep: function () {
            stepNavigator.next();
        }
    });
});
