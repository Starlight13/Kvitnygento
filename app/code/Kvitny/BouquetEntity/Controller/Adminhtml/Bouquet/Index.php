<?php

namespace Kvitny\BouquetEntity\Controller\Adminhtml\Bouquet;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Bouquet backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'Kvitny_BouquetEntity::bouquet_management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Kvitny_BouquetEntity::bouquet_management');
        $resultPage->addBreadcrumb(__('Bouquet'), __('Bouquet'));
        $resultPage->addBreadcrumb(__('Manage Bouquets'), __('Manage Bouquets'));
        $resultPage->getConfig()->getTitle()->prepend(__('Bouquet List'));

        return $resultPage;
    }
}
