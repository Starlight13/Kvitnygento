<?php


namespace Kvitny\Home\Block;


use Magento\Framework\View\Element\Template;

class Form extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getFormAction() {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder

        return '/kvitnyhome/Index/MakeBouquet';
        // here controller_name is index, action is booking
    }
}
