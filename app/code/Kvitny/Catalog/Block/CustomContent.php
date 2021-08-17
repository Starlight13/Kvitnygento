<?php

namespace Kvitny\Catalog\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Block\Product\View\AbstractView;
use Magento\Framework\Stdlib\ArrayUtils;


/**
 * Class CustomContent
 * @package Kvitny\Catalog\Block
 */
class CustomContent extends AbstractView
{
    /**
     * @var ListProduct
     */
    protected $listProduct;

    /**
     * CustomContent constructor.
     * @param Context $context
     * @param ArrayUtils $arrayUtils
     * @param ListProduct $listProduct
     * @param array $data
     */
    public function __construct(
        Context $context,
        ArrayUtils $arrayUtils,
        ListProduct $listProduct,
        array $data = []
    ) {
        $this->listProduct = $listProduct;
        parent::__construct($context, $arrayUtils, $data);
    }

    /**
     * @return mixed|null
     */
    public function getCustomContent()
    {
        if ($customContent = $this->getProduct()->getCustomAttribute('custom_content'))
            return $customContent->getValue();
        else
            return null;
    }

    /**
     * @param $product
     * @return array
     */
    public function getAddToCartPostParams()
    {
        return $this->listProduct->getAddToCartPostParams($this->getProduct());
    }
}
