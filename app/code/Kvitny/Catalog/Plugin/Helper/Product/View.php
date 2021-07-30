<?php

namespace Kvitny\Catalog\Plugin\Helper\Product;

use Magento\Catalog\Helper\Product\View as ProductView;
use Magento\Cms\Model\Template\FilterProvider;

/**
 * Class View
 * @package Kvitny\Catalog\Plugin\Helper\Product
 */
class View
{
    /**
     * @var FilterProvider
     */
    private $_filterProvider;

    /**
     * Constructor.
     *
     * @param FilterProvider $filterProvider
     */
    public function __construct(
        FilterProvider $filterProvider
    ) {
        $this->_filterProvider = $filterProvider;
    }

    /**
     * @param ProductView $subject
     * @param $result
     * @param $resultPage
     * @param $product
     * @param $params
     * @return $this
     * @throws \Exception
     */
    public function afterInitProductLayout(
        ProductView $subject,
        $result,
        $resultPage,
        $product,
        $params
    ) {
        $customContent = $product
            ->getResource()
            ->getAttribute('custom_content')
            ->getFrontend()
            ->getValue($product);

        $filteredCustomContent = $this->_filterProvider
            ->getPageFilter()
            ->filter($customContent);

        $product->setCustomAttribute('custom_content', $filteredCustomContent);

        return $this;
    }
}
