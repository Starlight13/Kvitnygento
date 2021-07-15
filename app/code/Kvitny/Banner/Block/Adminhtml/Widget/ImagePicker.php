<?php


namespace Kvitny\Banner\Block\Adminhtml\Widget;


use Magento\Framework\Data\Form\Element\AbstractElement as Element;
use Magento\Framework\View\Element\Template;

class ImagePicker extends Template
{
    protected $elementFactory;

    public function __construct(Template\Context $context,
                                \Magento\Framework\Data\Form\Element\Factory $elementFactory,
                                array $data = [])
    {
        $this->elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    public function prepareElementHtml(Element $element) {
        $config = $this->_getData('config');
        $sourceUrl = $this->getUrl('cms/wysiwyg_images/index',
            ['target_element_id' => $element->getId(), 'type' => 'file']);

        $picker = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel($config['button']['open'])
            ->setOnClick('MediabrowserUtility.openDialog(\'' . $sourceUrl . '\', 0, 0, "MediaBrowser", {})')
            ->setDisabled($element->getReadonly());

        $input = $this->elementFactory->create("text", ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setClass("widget-option input-text admin__control-text");
        if ($element->getRequired()) {
            $input->addClass('required-entry');
        }
        $element->setData('after_element_html', $input->getElementHtml() . $picker->toHtml()
            . "<script>require(['mage/adminhtml/browser']);</script>");
        return $element;
    }
}
