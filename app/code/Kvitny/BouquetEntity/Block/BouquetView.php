<?php


namespace Kvitny\BouquetEntity\Block;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Model\BouquetModelFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class BouquetView extends Template
{
    const BASE_IMAGE_PATH = 'catalog/bouquet';

    /**
     * @var BouquetModelFactory
     */
    protected BouquetModelFactory $bouquetModelFactory;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * BouquetView constructor.
     * @param Template\Context $context
     * @param BouquetModelFactory $bouquetModelFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        BouquetModelFactory $bouquetModelFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->bouquetModelFactory = $bouquetModelFactory;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set($this->getCurrentBouquet()->getBouquetName());

        return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getCurrentBouquet()
    {
        $bouquetId = $this->getRequest()->getParam(BouquetInterface::BOUQUET_ID);
        return $this->bouquetModelFactory->create()->load($bouquetId);
    }

    /**
     * @param $bouquet
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImage($bouquet)
    {
        return $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . BouquetInterface::BASE_IMAGE_PATH . '/' . $bouquet->getImage();
    }

}
