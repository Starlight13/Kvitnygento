<?php


namespace Kvitny\Catalog\Block;


use Magento\Catalog\Block\Product\View\AbstractView;

class CustomContent extends AbstractView
{
    public function getCustomContent() {
        if ($customContent = $this->getProduct()->getCustomAttribute('custom_content'))
            return $this->getProduct()->getCustomAttribute('custom_content')->getValue();
        else
            return null;
    }
}
