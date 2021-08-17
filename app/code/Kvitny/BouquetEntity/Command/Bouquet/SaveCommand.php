<?php

namespace Kvitny\BouquetEntity\Command\Bouquet;

use Exception;
use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Model\BouquetModel;
use Kvitny\BouquetEntity\Model\BouquetModelFactory;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetResource;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save Bouquet Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var BouquetModelFactory
     */
    private $modelFactory;

    /**
     * @var BouquetResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param BouquetModelFactory $modelFactory
     * @param BouquetResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        BouquetModelFactory $modelFactory,
        BouquetResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save Bouquet.
     *
     * @param BouquetInterface|DataObject $bouquet
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(BouquetInterface $bouquet): int
    {
        try {
            /** @var BouquetModel $model */
            $model = $this->modelFactory->create();
            $model->addData($bouquet->getData());
            $model->setHasDataChanges(true);

            if (!$model->getId()) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Bouquet. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Bouquet.'));
        }

        return (int)$model->getEntityId();
    }
}
