<?php

namespace Kvitny\Home\Block;

use Magento\Framework\View\Element\Template;

class Form extends Template
{
    /**
     * Form constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormAction() {
        return '/kvitnyhome/Index/MakeBouquet';
    }
}
