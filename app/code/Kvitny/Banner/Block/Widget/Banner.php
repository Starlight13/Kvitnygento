<?php


namespace Kvitny\Banner\Block\Widget;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Banner extends Template implements BlockInterface
{
    protected $_template = 'widget/banner.phtml';

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImage(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('banner_image');
    }

    public function getTitle()
    {
        return $this->getData('banner_title');
    }

    public function getSubtitle()
    {
        return $this->getData('banner_subtitle');
    }

    public function hasOrderButton(): bool
    {
        if ($this->getData('has-order-button') == "true")
            return true;
        return false;
    }
}
