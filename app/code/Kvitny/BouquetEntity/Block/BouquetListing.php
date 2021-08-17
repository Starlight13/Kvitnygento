<?php

namespace Kvitny\BouquetEntity\Block;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetModel\BouquetCollection;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetModel\BouquetCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class BouquetListing extends Template
{
    const BASE_PATH = 'catalog/bouquet';
    const DETAILS_URL_PATH = 'bouquet/bouquet/view';

    /**
     * @var BouquetCollectionFactory
     */
    protected BouquetCollectionFactory $_bouquetCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * BouquetListing constructor.
     * @param Template\Context $context
     * @param BouquetCollectionFactory $bouquetCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        BouquetCollectionFactory $bouquetCollectionFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->storeManager = $storeManager;
        $this->_bouquetCollectionFactory = $bouquetCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return BouquetCollection
     */
    public function getBouquetCollection()
    {
        return $this->_bouquetCollectionFactory->create();
    }

    /**
     * @param $bouquet
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImage($bouquet)
    {
        return $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
            . BouquetInterface::BASE_IMAGE_PATH . '/' . $bouquet->getImage();
    }

    /**
     * @param $bouquet
     * @return string
     */
    public function getDetailsUrl($bouquet)
    {
        if (isset($bouquet[BouquetInterface::BOUQUET_ID])) {
            $urlData = [BouquetInterface::BOUQUET_ID => $bouquet[BouquetInterface::BOUQUET_ID]];
            return $this->urlBuilder->getUrl(self::DETAILS_URL_PATH, $urlData);
        }
    }
}
