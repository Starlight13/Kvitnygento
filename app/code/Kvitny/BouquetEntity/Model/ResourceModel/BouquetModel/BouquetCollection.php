<?php

namespace Kvitny\BouquetEntity\Model\ResourceModel\BouquetModel;

use Kvitny\BouquetEntity\Model\BouquetModel;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class BouquetCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bouquet_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(BouquetModel::class, BouquetResource::class);
    }
}
