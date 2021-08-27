<?php

namespace Kvitny\FrontendGrid\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable;

/**
 * Class ProductActions
 * @package Kvitny\FrontendGrid\Ui\Component\Listing\Columns
 */
class ProductActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * @var Configurable
     */
    private Configurable $configurable;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Configurable $configurable
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Configurable $configurable,
        array $components = [],
        array $data = []
    ) {
        $this->configurable = $configurable;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $parentIds = $this->configurable->getParentIdsByChild($item['entity_id']);
                if (isset($parentIds[0])) {
                    $item[$this->getData('name')]['view'] = [
                        'href' => $this->urlBuilder->getUrl(
                            'catalog/product/view',
                            ['id' => $parentIds[0], 'store' => $storeId]
                        ),
                        'label' => __('View'),
                        'hidden' => false,
                    ];
                } else {
                    $item[$this->getData('name')]['view'] = [
                        'href' => $this->urlBuilder->getUrl(
                            'catalog/product/view',
                            ['id' => $item['entity_id'], 'store' => $storeId]
                        ),
                        'label' => __('View'),
                        'hidden' => false,
                    ];
                }
            }
        }

        return $dataSource;
    }
}
