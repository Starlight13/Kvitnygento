<?php

namespace Kvitny\Banner\Block\Widget;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class Banner
 * @package Kvitny\Banner\Block\Widget
 */
class Banner extends Template implements BlockInterface
{
    /**
     * @var string
     */
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

    /**
     * @return array|mixed|null
     */
    public function getTitle()
    {
        return $this->getData('banner_title');
    }

    /**
     * @return array|mixed|null
     */
    public function getSubtitle()
    {
        return $this->getData('banner_subtitle');
    }

    /**
     * @return bool
     */
    public function hasOrderButton(): bool
    {
        if ($this->getData('has-order-button') == "true")
            return true;
        return false;
    }
}
