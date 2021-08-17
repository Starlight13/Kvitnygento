<?php


namespace Kvitny\Catalog\Block\Widget;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Helper\Image as ImageHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class BenefitsBanner extends Template  implements BlockInterface
{
    /**
     * @var \Zend_Filter_Interface
     */
    protected $templateProcessor;

    /**
     * @var string
     */
    protected $_template = "widget/benefits_banner.phtml";

    /**
     * @var Registry
     */

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var ImageHelper
     */
    protected $imageHelper;

    /**
     * @var ListProduct
     */
    protected $listProduct;

    /**
     * BenefitsBanner constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param \Zend_Filter_Interface $templateProcessor
     * @param ListProduct $listProduct
     * @param ImageHelper $imageHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        \Zend_Filter_Interface $templateProcessor,
        ListProduct $listProduct,
        ImageHelper $imageHelper,
        array $data = []
    ) {
        $this->templateProcessor = $templateProcessor;
        $this->registry = $registry;
        $this->listProduct = $listProduct;
        $this->imageHelper = $imageHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getBannerImage(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('banner_image');
    }

    /**
     * @return mixed|null
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('product');
    }

    /**
     * @return array|mixed|null
     */
    public function getStoryTitle()
    {
        return $this->getData('story_title');
    }

    /**
     * @return array|mixed|null
     */
    public function getStoryText()
    {
        return $this->getData('story_text');
    }

    /**
     * @param $string
     * @return mixed
     * @throws \Zend_Filter_Exception
     */
    public function filterOutputHtml($string)
    {
        return $this->templateProcessor->filter($string);
    }

    /**
     * @return array|mixed|null
     */
    public function getBenefits()
    {
        return $this->getData('benefits');
    }

    /**
     * @param $product
     * @return string
     */
    public function getProductImage($product)
    {
        return $this->imageHelper->init($product, 'related_products_list')
            ->setImageFile($product->getRelatedProductListImage()) // image,small_image,thumbnail
            ->resize(200)
            ->getUrl();
    }

    /**
     * @param $product
     * @return array
     */
    public function getAddToCartPostParams($product)
    {
        return $this->listProduct->getAddToCartPostParams($product);
    }
}
