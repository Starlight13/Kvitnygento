<?php

namespace Kvitny\BouquetEntity\Query\Bouquet;

use Kvitny\BouquetEntity\Mapper\BouquetDataMapper;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetModel\BouquetCollection;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetModel\BouquetCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Get Bouquet list by search criteria query.
 */
class GetListQuery
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var BouquetCollectionFactory
     */
    private $entityCollectionFactory;

    /**
     * @var BouquetDataMapper
     */
    private $entityDataMapper;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param BouquetCollectionFactory $entityCollectionFactory
     * @param BouquetDataMapper $entityDataMapper
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        BouquetCollectionFactory $entityCollectionFactory,
        BouquetDataMapper $entityDataMapper,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $searchResultFactory
    )
    {
        $this->collectionProcessor = $collectionProcessor;
        $this->entityCollectionFactory = $entityCollectionFactory;
        $this->entityDataMapper = $entityDataMapper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * Get Bouquet list by search criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return SearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var BouquetCollection $collection */
        $collection = $this->entityCollectionFactory->create();

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $entityDataObjects = $this->entityDataMapper->map($collection);

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($entityDataObjects);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
