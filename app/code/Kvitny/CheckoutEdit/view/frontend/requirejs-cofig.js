var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Kvitny_CheckoutEdit/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Kvitny_CheckoutEdit/js/view/shipping-payment-mixin': true
            }
        }
    }
}
