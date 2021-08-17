var config = {
    paths: {
        slick: 'js/libs/slick.min'
    },
    shim: {
        slick: {
            deps: ['jquery']
        }
    },
    map: {
        '*': {
            instagramCarousel: 'Magento_Theme/js/instagram-carousel',
            messagesHide: 'Magento_Theme/js/messages-hide',
            navigationBurger: 'Magento_Theme/js/navigation-burger',
            arrowUp: 'Magento_Theme/js/arrow-up',
            headerTransparency: 'Magento_Theme/js/header-transparency'
        }
    }
};
