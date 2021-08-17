<?php

namespace Kvitny\BouquetEntity\Controller\Adminhtml\Bouquet;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Kvitny\BouquetEntity\Api\Data\BouquetInterfaceFactory;
use Kvitny\BouquetEntity\Command\Bouquet\SaveCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Save Bouquet controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Kvitny_BouquetEntity::bouquet_management';

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var SaveCommand
     */
    private SaveCommand $saveCommand;

    /**
     * @var BouquetInterfaceFactory
     */
    private BouquetInterfaceFactory $entityDataFactory;

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    private Filesystem\Directory\WriteInterface $mediaDirectory;

    /**
     * @var File
     */
    private File $file;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param BouquetInterfaceFactory $entityDataFactory
     * @param Filesystem $filesystem
     * @param File $file
     * @param StoreManagerInterface $storeManager
     * @throws FileSystemException
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCommand $saveCommand,
        BouquetInterfaceFactory $entityDataFactory,
        Filesystem $filesystem,
        File $file,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->file = $file;
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save Bouquet Action.
     *
     * @return ResultInterface
     * @throws FileSystemException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();


        $filteredParams = $this->_filterCategoryPostData($params);

        try {
            /** @var BouquetInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($filteredParams['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The Bouquet data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                'bouquet_id' => $this->getRequest()->getParam('bouquet_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param array $rawData
     * @return array
     * @throws FileSystemException|NoSuchEntityException
     */
    protected function _filterCategoryPostData(array $rawData)
    {
        $data = $rawData;

        if (isset($data['general']['image']) && is_array($data['general']['image'])) {
            if (!empty($data['general']['image']['delete'])) {
                $data['general']['image'] = null;
            } else {
                if (isset($data['general']['image'][0]['name'])) {
                    if (isset($data['general']['image'][0]['tmp_name'])) {
                        $this->mediaDirectory->copyFile(
                            BouquetInterface::BASE_TMP_IMAGE_PATH . '/' . $data['general']['image'][0]['name'],
                            BouquetInterface::BASE_IMAGE_PATH . '/' . $data['general']['image'][0]['name']
                        );
                        $this->file->deleteFile($this->mediaDirectory->getAbsolutePath() .
                            BouquetInterface::BASE_TMP_IMAGE_PATH . '/' . $data['general']['image'][0]['name']);
                    } else {
                        $baseMediaUrl = $this->getBaseMediaUrl();
                        if (!str_contains($data['general']['image'][0]['url'], $baseMediaUrl)) {
                            $this->mediaDirectory->copyFile(
                                ltrim($data['general']['image'][0]['url'], 'media/'),
                                BouquetInterface::BASE_IMAGE_PATH . '/' . $data['general']['image'][0]['name']
                            );
                        }
                    }
                    $data['general']['image'] = $data['general']['image'][0]['name'];
                } else {
                    unset($data['general']['image']);
                }
            }
        }
        return $data;
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getBaseMediaUrl()
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
