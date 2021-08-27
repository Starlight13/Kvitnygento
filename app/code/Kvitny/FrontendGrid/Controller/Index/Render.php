<?php

namespace Kvitny\FrontendGrid\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Result\PageFactory;

class Render extends Action
{
    private UiComponentFactory $uiComponentFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        UiComponentFactory $uiComponentFactory,
        Session $customerSession
    )
    {
        $this->uiComponentFactory = $uiComponentFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->getParam('namespace') === null) {
            $this->_redirect('cms/index/index');
            return;
        }
        $component = $this->uiComponentFactory->create($this->_request->getParam('namespace'));
        $this->prepareComponent($component);
        $this->_response->appendBody((string) $component->render());
    }

    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}
