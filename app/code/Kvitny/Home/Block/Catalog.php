<?php


namespace Kvitny\Home\Block;


use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Catalog extends Template
{
    protected CollectionFactory $collectionFactory;

    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getCategories() {
        return $this->collectionFactory->create()
            ->addAttributeToSelect('*')
            ->setProductStoreId($this->_storeManager->getStore()->getId());
    }
}
