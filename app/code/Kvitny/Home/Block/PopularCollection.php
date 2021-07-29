<?php

namespace Kvitny\Home\Block;

use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Framework\App\Action\Action;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Catalog\Model\Product\Attribute\Source\Status;

class PopularCollection extends Template
{
    /**
     * @var BestSellersCollectionFactory
     */
    protected BestSellersCollectionFactory $_bestSellersCollectionFactory;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $_productCollectionFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var Image
     */
    protected $imageHelper;
    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var ListProduct
     */
    protected $listProduct;

    protected Configurable $configurable;

    public function __construct(
        Context $context,
        Image $imageHelper,
        ProductFactory $productFactory,
        CollectionFactory $productCollectionFactory,
        StoreManagerInterface $storeManager,
        BestSellersCollectionFactory $bestSellersCollectionFactory,
        ListProduct $listProduct,
        Configurable $configurable,
        $data = []
    )
    {
        $this->imageHelper = $imageHelper;
        $this->productFactory = $productFactory;
        $this->_bestSellersCollectionFactory = $bestSellersCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->listProduct = $listProduct;
        $this->configurable = $configurable;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $productIds = [];
        $bestSellers = $this->_bestSellersCollectionFactory->create()
            ->setPeriod('month');
        foreach ($bestSellers as $product) {
            $productIds[] = $product->getProductId();
        }
        $collection = $this->_productCollectionFactory->create()->addIdFilter($productIds);
        $collection
            ->addAttributeToSelect('*')
            ->addStoreFilter($this->getStoreId())
            ->addAttributeToFilter('status', Status::STATUS_ENABLED)
            ->setPageSize(count($productIds));
        return $collection;
    }

    public function getProductImageUrl($id)
    {
        try
        {
            $product = $this->productFactory->create()->load($id);
        }
        catch (NoSuchEntityException $e)
        {
            return 'Data not found';
        }
        return $this->imageHelper->init($product, 'carousel_image')->getUrl();
    }

    public function getConfigurableParent($id) {
        $product = $this->configurable->getParentIdsByChild($id);
        if (isset($product[0]))
            return $this->productFactory->create()->load($product[0]);
        return null;
    }

    public function getCurrency()
    {
        return $this->_storeManager->getStore()->getCurrentCurrencyCode();
    }

    public function getAddToCartPostParams($product) {
        return $this->listProduct->getAddToCartPostParams($product);
    }

    public function getParamNameUrlEncoded() {
        return Action::PARAM_NAME_URL_ENCODED;
    }
}
