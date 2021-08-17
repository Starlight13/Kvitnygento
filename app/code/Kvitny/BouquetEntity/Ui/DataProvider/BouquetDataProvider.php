<?php

namespace Kvitny\BouquetEntity\Ui\DataProvider;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Query\Bouquet\GetListQuery;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\SearchResultFactory;

/**
 * DataProvider component.
 */
class BouquetDataProvider extends DataProvider
{
    /**
     * @var GetListQuery
     */
    private $getListQuery;

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var array
     */
    private $loadedData = [];

    private $storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param GetListQuery $getListQuery
     * @param SearchResultFactory $searchResultFactory
     * @param StoreManagerInterface $storeManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        GetListQuery $getListQuery,
        SearchResultFactory $searchResultFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->storeManager = $storeManager;
        $this->getListQuery = $getListQuery;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @inheritDoc
     */
    public function getSearchResult()
    {
        $searchCriteria = $this->getSearchCriteria();
        $result = $this->getListQuery->execute($searchCriteria);

        return $this->searchResultFactory->create(
            $result->getItems(),
            $result->getTotalCount(),
            $searchCriteria,
            'bouquet_id'
        );
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData(): array
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }
        $this->loadedData = parent::getData();
        $itemsById = [];

        foreach ($this->loadedData['items'] as $item) {
            if ($item['image']) {
                $image_temp = [];
                $image_temp[0]['name'] = $item["image"];
                $image_temp[0]['url'] = $this->getMediaUrl().$item['image'];
                $image_temp[0]['type'] = 'image';
                $item['image'] = $image_temp;
            }
            $itemsById[(int)$item['bouquet_id']] = $item;
        }

        if ($id = $this->request->getParam('bouquet_id', null)) {
            $this->loadedData['items'][0] = $itemsById[(int)$id];
        }

        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . BouquetInterface::BASE_IMAGE_PATH . '/';
        return $mediaUrl;
    }
}
