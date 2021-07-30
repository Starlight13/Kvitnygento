<?php

namespace Kvitny\Header\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\Information;

class PhoneNumber extends Template
{
    /**
     * @var Information
     */
    protected Information $_storeInfo;

    /**
     * PhoneNumber constructor.
     * @param Context $context
     * @param Information $storeInfo
     * @param array $data
     */
    public function __construct(
        Context $context,
        Information $storeInfo,
        array $data = []
    ) {
        $this->_storeInfo = $storeInfo;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getPhoneNumber() {
        return $this->_storeInfo->getStoreInformationObject($this->_storeManager->getStore())->getPhone();
    }
}
