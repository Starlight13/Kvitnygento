<?php


namespace Kvitny\Home\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class MakeBouquet extends Action
{
    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            $name = $post['name'];
            $phone = $post['telephone'];
            $email = $post['email'];

            $this->messageManager->addSuccessMessage('Application sent!');

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/');

            return $resultRedirect;
        }

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
