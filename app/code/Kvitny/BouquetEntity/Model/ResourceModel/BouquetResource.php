<?php

namespace Kvitny\BouquetEntity\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BouquetResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bouquet_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('bouquet', 'bouquet_id');
        $this->_useIsObjectNew = true;
    }
}
