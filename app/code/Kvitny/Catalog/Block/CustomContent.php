<?php

namespace Kvitny\Catalog\Block;

use Magento\Catalog\Block\Product\View\AbstractView;

/**
 * Class CustomContent
 * @package Kvitny\Catalog\Block
 */
class CustomContent extends AbstractView
{
    /**
     * @return mixed|null
     */
    public function getCustomContent() {
        if ($customContent = $this->getProduct()->getCustomAttribute('custom_content'))
            return $this->getProduct()->getCustomAttribute('custom_content')->getValue();
        else
            return null;
    }
}
