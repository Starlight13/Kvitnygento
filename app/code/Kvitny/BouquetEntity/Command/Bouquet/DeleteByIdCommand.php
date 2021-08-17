<?php

namespace Kvitny\BouquetEntity\Command\Bouquet;

use Exception;
use Kvitny\BouquetEntity\Model\BouquetModel;
use Kvitny\BouquetEntity\Model\BouquetModelFactory;
use Kvitny\BouquetEntity\Model\ResourceModel\BouquetResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete Bouquet by id Command.
 */
class DeleteByIdCommand
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
     * Delete Bouquet.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function execute(int $entityId)
    {
        try {
            /** @var BouquetModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, 'bouquet_id');

            if (!$model->getData('bouquet_id')) {
                throw new NoSuchEntityException(
                    __('Could not find Bouquet with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Bouquet. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Bouquet.'));
        }
    }
}
