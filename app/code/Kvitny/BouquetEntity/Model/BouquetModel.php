<?php

namespace Kvitny\BouquetEntity\Model;

use Kvitny\BouquetEntity\Model\ResourceModel\BouquetResource;
use Magento\Framework\Model\AbstractModel;

class BouquetModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bouquet_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(BouquetResource::class);
    }
}
