<?php

namespace Kvitny\BouquetEntity\Mapper;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Api\Data\BouquetInterfaceFactory;
use Kvitny\BouquetEntity\Model\BouquetModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of Bouquet entities to an array of data transfer objects.
 */
class BouquetDataMapper
{
    /**
     * @var BouquetInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param BouquetInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        BouquetInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|BouquetInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var BouquetModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var BouquetInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
