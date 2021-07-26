<?php


namespace Kvitny\Header\Block;

use Magento\Framework\View\Element\Template;

class PhoneNumber extends Template
{
    protected \Magento\Store\Model\Information $_storeInfo;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\Information $storeInfo,
        array $data = []
    )
    {
        $this->_storeInfo = $storeInfo;
        parent::__construct($context, $data);
    }

    public function getPhoneNumber() {
        return $this->_storeInfo->getStoreInformationObject($this->_storeManager->getStore())->getPhone();
    }
}
